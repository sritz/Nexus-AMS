<?php

namespace Tests\Feature;

use App\Models\Alliance;
use App\Models\Nation;
use App\Models\Page;
use App\Models\User;
use App\Services\SettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ApplicantEntryPathTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        config()->set('services.pw.alliance_id', 123);
        SettingService::setApplicationsEnabled(true);
        SettingService::setRecruitmentEnabled(true);

        Alliance::factory()->create([
            'id' => 123,
            'name' => 'Nexus Test Alliance',
            'acronym' => 'NTA',
            'discord_link' => 'https://discord.gg/nexus-test',
        ]);

        Page::query()->create([
            'slug' => 'apply',
            'status' => Page::STATUS_PUBLISHED,
            'published' => '<p>Applicants must follow recruitment policy.</p>',
            'cached_html' => '<p>Applicants must follow recruitment policy.</p>',
        ]);
    }

    public function test_logged_out_applicant_sees_the_canonical_discord_application_path(): void
    {
        $response = $this->get(route('apply.show', [
            'utm_campaign' => 'summer-drive',
            'email' => 'not-retained@example.test',
        ]));

        $response
            ->assertOk()
            ->assertSee('Applications start in Politics &amp; War and finish in Discord.', false)
            ->assertSee('You do not need a '.config('app.name').' account to apply')
            ->assertSee(route('apply.start', ['utm_campaign' => 'summer-drive']), false)
            ->assertSee('https://discord.gg/nexus-test', false)
            ->assertSee('/apply nationid:&lt;your nation ID&gt;', false)
            ->assertSee(route('apply.member-registration', ['utm_campaign' => 'summer-drive']), false)
            ->assertSee('RECRUITMENT TRACTOR BEAM: ONLINE')
            ->assertDontSee('RECRUITMENT TRACTOR BEAM: OFFLINE')
            ->assertDontSee('not-retained@example.test')
            ->assertDontSee('href="'.route('register').'"', false);
    }

    public function test_application_start_redirects_to_politics_and_war_and_logs_safe_campaign_context(): void
    {
        Log::spy();

        $response = $this->get(route('apply.start', [
            'utm_source' => "newsletter\nheader",
            'utm_campaign' => 'fall launch',
            'email' => 'not-retained@example.test',
        ]));

        $response->assertRedirect('https://politicsandwar.com/alliance/join/id=123');

        Log::shouldHaveReceived('info')->withArgs(
            fn (string $message, array $context): bool => $message === 'Recruitment funnel event.'
                && $context === [
                    'event' => 'applicant_start_clicked',
                    'destination' => 'politics_and_war',
                    'campaign' => [
                        'utm_source' => 'newsletter-header',
                        'utm_campaign' => 'fall-launch',
                    ],
                ]
        )->once();
    }

    public function test_paused_applications_do_not_send_an_applicant_to_an_external_dead_end(): void
    {
        SettingService::setApplicationsEnabled(false);
        SettingService::setRecruitmentEnabled(false);

        $this->get(route('apply.start'))
            ->assertRedirect(route('apply.show'))
            ->assertSessionHas('alert-type', 'warning');

        $this->get(route('apply.show'))
            ->assertOk()
            ->assertSee('Applications are currently paused')
            ->assertDontSee('Start in Politics &amp; War', false);
    }

    public function test_recruitment_tractor_beam_badge_reflects_recruitment_setting(): void
    {
        SettingService::setRecruitmentEnabled(true);
        $this->get(route('apply.show'))
            ->assertOk()
            ->assertSee('RECRUITMENT TRACTOR BEAM: ONLINE')
            ->assertDontSee('RECRUITMENT TRACTOR BEAM: OFFLINE');

        SettingService::setRecruitmentEnabled(false);
        $this->get(route('apply.show'))
            ->assertOk()
            ->assertSee('RECRUITMENT TRACTOR BEAM: OFFLINE')
            ->assertDontSee('RECRUITMENT TRACTOR BEAM: ONLINE');
    }

    public function test_existing_member_registration_is_a_separate_tracked_path(): void
    {
        Log::spy();

        $this->get(route('apply.member-registration', ['ref' => 'member-help']))
            ->assertRedirect(route('register'));

        Log::shouldHaveReceived('info')->withArgs(
            fn (string $message, array $context): bool => $message === 'Recruitment funnel event.'
                && $context === [
                    'event' => 'existing_member_registration_selected',
                    'campaign' => ['ref' => 'member-help'],
                ]
        )->once();
    }

    public function test_authenticated_member_is_directed_to_the_member_app(): void
    {
        $nation = Nation::factory()->create([
            'id' => 123001,
            'alliance_id' => 123,
            'alliance_position' => 'MEMBER',
        ]);
        $user = User::factory()->verified()->create(['nation_id' => $nation->id]);

        $this->actingAs($user)
            ->get(route('apply.show'))
            ->assertOk()
            ->assertSee(route('user.dashboard'), false)
            ->assertSee('Your account is already set up')
            ->assertDontSee('Register as a member');
    }

    public function test_registration_page_sends_applicants_back_to_the_application_path(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertSee('For current alliance members')
            ->assertSee('Applicant nations cannot register here')
            ->assertSee(route('apply.show'), false);
    }

    public function test_discord_buttons_link_to_canonical_invite_fallback_when_unconfigured(): void
    {
        Alliance::query()->update(['discord_link' => null]);

        $this->get(route('apply.show'))
            ->assertOk()
            ->assertSee('https://discord.gg/VrJFQMBH2R', false)
            ->assertDontSee('Ask recruitment staff for the official Discord invite');
    }

    public function test_step_one_shows_application_start_when_recruitment_is_enabled(): void
    {
        SettingService::setApplicationsEnabled(false);
        SettingService::setRecruitmentEnabled(true);

        $this->get(route('apply.show'))
            ->assertOk()
            ->assertSee('Start in Politics &amp; War', false)
            ->assertDontSee('Applications are currently paused');

        $this->get(route('apply.start'))
            ->assertRedirect('https://politicsandwar.com/alliance/join/id=123');
    }
}
