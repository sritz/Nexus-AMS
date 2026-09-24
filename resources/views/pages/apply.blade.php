<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  @php
      $resolvedSeo = $seo ?? null;
      $publicSiteName = $resolvedSeo?->siteName ?? config('app.name');
      $effectiveAllianceName = $allianceName ?? 'Black Knights';
      $effectiveAllianceId = ($primaryAllianceId ?? 0) > 0 ? $primaryAllianceId : 877;
      $effectiveDiscordUrl = !empty($discordUrl) ? $discordUrl : 'https://discord.gg/VrJFQMBH2R';
  @endphp
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="application-name" content="{{ config('app.name') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if($resolvedSeo)
      <title>{{ $resolvedSeo->title }}</title>
      <meta name="robots" content="{{ $resolvedSeo->robots ?? 'noindex, nofollow' }}">
      <meta name="description" content="{{ $resolvedSeo->description }}">
      <link rel="canonical" href="{{ $resolvedSeo->canonical }}">

      <meta property="og:type" content="website">
      <meta property="og:site_name" content="{{ $resolvedSeo->siteName }}">
      <meta property="og:title" content="{{ $resolvedSeo->title }}">
      <meta property="og:description" content="{{ $resolvedSeo->description }}">
      <meta property="og:url" content="{{ $resolvedSeo->canonical }}">
      <meta name="twitter:card" content="{{ $resolvedSeo->twitterCard() }}">
      <meta name="twitter:title" content="{{ $resolvedSeo->title }}">
      <meta name="twitter:description" content="{{ $resolvedSeo->description }}">

      @if($resolvedSeo->imageUrl)
          <meta property="og:image" content="{{ $resolvedSeo->imageUrl }}">
          <meta property="og:image:alt" content="{{ $resolvedSeo->imageAlt }}">
          <meta name="twitter:image" content="{{ $resolvedSeo->imageUrl }}">
          <meta name="twitter:image:alt" content="{{ $resolvedSeo->imageAlt }}">
      @endif

      @if($resolvedSeo->structuredData)
          <script type="application/ld+json">{!! Illuminate\Support\Js::encode($resolvedSeo->structuredData) !!}</script>
      @endif
  @else
      <title>{{ $title ?? 'Apply' }} · {{ config('app.name') }}</title>
      <meta name="robots" content="noindex, nofollow">
  @endif

  <link rel="icon" href="{{ asset('favicon.ico') }}">

  <x-theme-init />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800;900&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            alien: {
              300: '#86efac',
              400: '#4ade80',
              DEFAULT: '#00ff66',
              500: '#00ff66',
              600: '#16a34a',
              700: '#15803d',
              glow: 'rgba(0, 255, 102, 0.45)',
            },
            chrome: {
              100: '#ffffff',
              200: '#f1f5f9',
              300: '#cbd5e1',
              400: '#94a3b8',
              500: '#64748b',
              600: '#475569',
              700: '#334155',
            },
            void: {
              950: '#020408',
              900: '#060b13',
              850: '#0b121e',
              800: '#10192a',
              750: '#162238',
              700: '#1e2d48'
            }
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            display: ['Orbitron', 'sans-serif'],
            mono: ['JetBrains Mono', 'monospace'],
          },
          animation: {
            'beam-pulse': 'beamPulse 4s ease-in-out infinite',
            'float-slow': 'float 5s ease-in-out infinite',
            'ufo-hover': 'ufoHover 6s ease-in-out infinite',
            'ring-expand': 'ringExpand 3s ease-out infinite',
            'radar-spin': 'radarSpin 10s linear infinite',
          },
          keyframes: {
            beamPulse: {
              '0%, 100%': { opacity: '0.7', filter: 'drop-shadow(0 0 15px rgba(0,255,102,0.4))' },
              '50%': { opacity: '0.95', filter: 'drop-shadow(0 0 25px rgba(0,255,102,0.7))' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
              '50%': { transform: 'translateY(-10px) rotate(1.5deg)' },
            },
            ufoHover: {
              '0%, 100%': { transform: 'translate(0px, 0px) rotate(0deg)' },
              '25%': { transform: 'translate(5px, -4px) rotate(1.5deg)' },
              '75%': { transform: 'translate(-5px, 3px) rotate(-1.5deg)' },
            },
            ringExpand: {
              '0%': { transform: 'scale(0.8) translateY(0px)', opacity: '0.8' },
              '100%': { transform: 'scale(1.25) translateY(120px)', opacity: '0' }
            },
            radarSpin: {
              '0%': { transform: 'rotate(0deg)' },
              '100%': { transform: 'rotate(360deg)' },
            }
          }
        }
      }
    }
  </script>
  <style>
    html {
      scroll-padding-top: 5.5rem;
    }
    .glass-panel {
      background: rgba(11, 18, 30, 0.75);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border: 1px solid rgba(0, 255, 102, 0.16);
    }
    .glass-panel:hover:not(header):not(footer) {
      border-color: rgba(0, 255, 102, 0.38);
    }
    .alien-glow {
      box-shadow: 0 0 25px rgba(0, 255, 102, 0.35), inset 0 0 15px rgba(0, 255, 102, 0.08);
    }
    .neon-text-glow {
      text-shadow: 0 0 12px rgba(0, 255, 102, 0.65), 0 0 25px rgba(0, 255, 102, 0.3);
    }
    .cyber-grid {
      background-size: 40px 40px;
      background-image: 
        linear-gradient(to right, rgba(0, 255, 102, 0.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0, 255, 102, 0.04) 1px, transparent 1px);
    }
    .hud-corner {
      position: relative;
    }
    .hud-corner::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      width: 10px;
      height: 10px;
      border-top: 2px solid #00ff66;
      border-left: 2px solid #00ff66;
      pointer-events: none;
    }
    .hud-corner::after {
      content: '';
      position: absolute;
      bottom: -2px;
      right: -2px;
      width: 10px;
      height: 10px;
      border-bottom: 2px solid #00ff66;
      border-right: 2px solid #00ff66;
      pointer-events: none;
    }
    .metallic-badge {
      background: linear-gradient(145deg, #1e293b 0%, #090e17 100%);
      box-shadow: inset 1px 1px 1px rgba(255, 255, 255, 0.15), 0 4px 14px rgba(0, 0, 0, 0.6);
    }
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #060b13;
    }
    ::-webkit-scrollbar-thumb {
      background: #15803d;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #00ff66;
    }
  </style>
</head>
<body class="bg-void-950 text-slate-200 font-sans antialiased overflow-x-hidden selection:bg-alien selection:text-black">

  <a href="#hero" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:p-3 focus:bg-alien focus:text-black focus:font-mono focus:rounded-lg">Skip to main content</a>

  <!-- Official Black Knights Emblem (Direct Vector Embed from Alliance Inkscape Master) -->
  <svg class="hidden">
    <defs>
      <symbol id="bk-crest-symbol" viewBox="0 0 150.15552 134.74237">
        <g transform="translate(-23.759544,-85.462326)">
          <path style="fill:#b8b8b8;fill-opacity:1;stroke-width:0.695489" d="m 374.21262,323.08873 c -0.61766,45.64095 -0.22312,91.30169 -0.33959,136.95026 7.3834,2.20208 15.46668,3.75558 23.10736,5.02871 1.1571,-5.70855 -0.73619,-11.81247 -1.23341,-17.59371 -7.04037,-41.4419 -13.85975,-82.96564 -20.94211,-124.39749 l -0.0394,-0.0693 z" id="path2" transform="scale(0.26458333)" />
          <path style="fill:#d0d0d0;fill-opacity:1;stroke-width:0.695489" d="m 372.21852,324.40364 c -5.12587,27.42808 -9.12408,55.05961 -14.10732,82.52102 -2.82214,19.06303 -6.93293,37.97643 -8.88593,57.14599 0.95013,2.50623 4.64178,-0.17406 6.46161,0.0416 5.74853,-1.32122 11.8579,-2.02265 17.39014,-3.69834 -0.0921,-45.32041 0.23001,-90.64875 -0.27439,-135.96408 l -0.55151,-0.10052 z" id="path3" transform="scale(0.26458333)" />
          <path style="fill:#5a5a5a;fill-opacity:1;stroke-width:0.695489" d="m 375.60768,461.39329 c -1.42093,1.47081 1.58076,3.94983 1.85554,5.52859 3.80402,6.52029 6.63431,13.65938 11.00557,19.81737 2.42698,-2.43182 3.23939,-6.77237 4.98336,-9.89198 1.01,-3.4685 4.03366,-7.16961 3.36116,-10.82599 -4.41958,-1.72525 -9.32846,-2.02419 -13.93571,-3.18081 -2.46977,-0.29369 -4.88914,-0.91083 -7.26992,-1.44718 z" id="path4" transform="scale(0.26458333)" />
          <path style="fill:#b8b8b8;fill-opacity:1;stroke-width:0.695489" d="m 371.80829,461.27511 c -6.95239,2.55949 -15.01305,1.92822 -21.63216,5.31669 -0.44177,3.09703 2.32853,6.11078 3.12565,9.092 1.98679,3.05979 2.25827,7.76992 5.25282,9.98098 3.13733,-1.76194 3.74137,-6.34591 5.87706,-9.12449 2.36218,-5.09254 6.11899,-9.83761 7.78686,-15.11033 -0.0884,-0.12926 -0.25937,-0.19059 -0.41023,-0.15485 z" id="path5" transform="scale(0.26458333)" />
          <path style="fill:#898989;fill-opacity:1;stroke-width:0.695489" d="m 374.21262,463.51372 c -0.5877,88.44918 -0.18548,176.90662 -0.27439,265.35904 2.25636,-2.25067 2.96333,-7.22616 4.58792,-10.58695 3.72572,-10.88589 8.75451,-21.42308 11.53602,-32.58636 -1.84306,-8.13623 -0.73664,-16.79779 -1.24439,-25.13665 -0.52775,-57.72079 -0.47376,-115.4575 -0.82034,-173.17153 -4.66009,-7.9012 -8.79821,-16.24472 -13.35829,-24.12206 l -0.0394,-0.0122 z" id="path6" transform="scale(0.26458333)" />
          <path style="fill:#d0d0d0;fill-opacity:1;stroke-width:0.695489" d="m 370.00844,467.85917 c -3.51618,6.90177 -7.99414,13.41516 -11.0914,20.37293 -0.4383,65.53197 -0.1674,131.07772 -1.35405,196.59934 -0.42165,6.55792 3.77092,12.4128 5.43645,18.57904 3.27415,8.39254 5.96832,17.06442 9.42012,25.35633 1.23069,-4.33264 0.1962,-10.03586 0.55895,-14.88102 0.15447,-83.56321 0.0645,-167.12663 0.0754,-250.68993 -1.55224,0.1492 -1.97325,3.38903 -3.04549,4.66331 z" id="path7" transform="scale(0.26458333)" />
          <path style="fill:#000000;fill-opacity:0;stroke-width:0.695489" d="m 449.47624,642.69865 c -0.83903,1.65998 -0.26602,4.15161 -2.38531,5.26643 -9.1331,7.44522 -18.96541,14.14466 -28.3833,21.14858 -8.02819,5.88274 -15.97014,12.25608 -24.83249,16.98243 -4.83751,0.56538 -4.54273,6.89328 -6.46588,10.21908 -4.01976,10.77374 -8.14567,21.58356 -12.13031,32.32666 -0.19522,2.92141 3.24025,-0.27254 4.11626,-0.78398 31.6298,-21.97313 63.48723,-43.7055 95.10507,-65.72354 1.59821,-0.90755 3.27068,-3.17647 0.90739,-4.36175 -8.84003,-4.65305 -17.15029,-10.42601 -25.93143,-15.07391 z" id="path8" transform="scale(0.26458333)" />
          <path style="fill:#a1a1a1;fill-opacity:1;stroke-width:0.695489" d="m 421.76806,594.30917 c 0.50502,3.77866 3.70403,7.20961 5.32335,10.74356 7.47753,12.14321 14.21611,24.85058 22.80593,36.24951 4.50279,4.81562 10.88255,6.97056 16.23804,10.60213 3.10745,1.31217 5.77106,3.79652 8.83625,4.96351 -0.75305,-4.37416 -3.85181,-8.64215 -5.48405,-12.92405 -6.29503,-14.11121 -13.89582,-27.7945 -18.92056,-42.38364 -3.78965,-1.89707 -8.4381,-1.95777 -12.49345,-3.34252 -5.43575,-1.22858 -10.8847,-2.85169 -16.30551,-3.9085 z" id="path9" transform="scale(0.26458333)" />
          <path style="fill:#d0d0d0;fill-opacity:1;stroke-width:0.695489" d="m 656.92086,476.68047 c -27.20569,11.91645 -53.65661,25.57472 -80.57642,38.15227 -50.18612,24.15577 -100.55938,47.93752 -150.61254,72.35901 -1.65956,1.29326 -6.30896,2.60594 -5.05326,5.36511 5.73827,3.00071 12.65691,3.35469 18.79723,5.4145 3.59971,0.31043 7.71231,3.10362 11.22155,1.49692 0.93546,-3.60911 3.51863,-6.47867 6.82577,-8.18832 34.51792,-20.07729 69.4561,-39.41889 104.099,-59.28493 31.54751,-18.01296 63.26869,-35.74214 94.66159,-54.01324 0.27112,-0.1845 1.71856,-1.04943 0.63708,-1.30132 z" id="path10" transform="scale(0.26458333)" />
          <path style="fill:#434343;fill-opacity:1;stroke-width:0.695489" d="m 646.40295,484.98423 c -21.5634,10.98348 -42.08169,23.9383 -63.37358,35.45129 -42.1506,24.0555 -84.36865,48.08518 -126.56835,72.06021 -2.52176,1.70964 -5.08685,4.76774 -4.55464,7.81067 6.31989,-0.76836 12.99681,-0.68344 19.10694,-2.16389 3.08242,-3.73984 4.88467,-8.56497 9.29266,-11.14006 19.42553,-12.97019 39.92025,-24.28301 59.75585,-36.61673 35.12459,-21.30036 70.35052,-42.44734 105.40791,-63.85022 0.21383,-0.23063 2.21313,-1.2759 0.93321,-1.55127 z" id="path11" transform="scale(0.26458333)" />
          <path style="fill:#5a5a5a;fill-opacity:1;stroke-width:0.695489" d="m 468.89289,599.09881 c -5.6664,1.09441 -11.92005,0.14158 -17.3818,2.02126 -0.008,3.80497 2.77024,7.28302 3.29678,11.07349 2.07842,1.07056 1.80265,4.20545 3.24924,6.05701 1.12623,1.7098 0.87099,4.42632 2.75343,5.26779 4.59043,11.37761 10.8258,22.25371 15.32658,33.5723 2.02248,1.91355 1.97856,5.4688 3.76571,7.71594 16.40107,33.67248 31.7741,67.84965 48.29139,101.45686 1.81062,-0.0464 -0.62998,-3.40282 -0.5515,-4.4256 C 509.34663,710.112 490.73329,658.4619 472.41245,606.76685 c -0.89667,-2.60259 -0.18132,-5.67014 -0.91691,-8.07692 -0.86755,0.13629 -1.7351,0.27259 -2.60265,0.40888 z" id="path12" transform="scale(0.26458333)" />
          <path style="fill:#a1a1a1;fill-opacity:1;stroke-width:0.695489" d="m 478.40425,664.25882 c -2.89612,4.22693 -5.12192,9.28827 -6.50527,14.23308 17.66219,27.46549 34.39022,55.55125 51.70256,83.24001 0.66925,1.64633 2.2814,0.57967 1.20353,-0.75933 -15.22273,-31.75303 -29.85649,-63.8227 -45.28559,-95.48172 -0.35396,-0.30651 -0.47325,-1.31334 -1.11523,-1.23204 z" id="path13" transform="scale(0.26458333)" />
          <path style="fill:#000000;fill-opacity:0;stroke-width:0.695489" d="m 449.47624,642.69865 c -0.83903,1.65998 -0.26602,4.15161 -2.38531,5.26643 -9.1331,7.44522 -18.96541,14.14466 -28.3833,21.14858 -8.02819,5.88274 -15.97014,12.25608 -24.83249,16.98243 -4.83751,0.56538 -4.54273,6.89328 -6.46588,10.21908 -4.01976,10.77374 -8.14567,21.58356 -12.13031,32.32666 -0.19522,2.92141 3.24025,-0.27254 4.11626,-0.78398 31.6298,-21.97313 63.48723,-43.7055 95.10507,-65.72354 1.59821,-0.90755 3.27068,-3.17647 0.90739,-4.36175 -8.84003,-4.65305 -17.15029,-10.42601 -25.93143,-15.07391 z" id="path14" transform="scale(0.26458333)" />
          <path style="fill:#434343;fill-opacity:1;stroke-width:0.695489" d="m 477.37324,661.62356 c -8.81761,4.61827 -16.49298,11.09339 -24.81569,16.52212 -26.00843,18.00413 -52.04869,35.97322 -78.20366,53.76441 4.59936,6.28176 11.69762,10.78495 17.06666,16.64556 1.10283,1.12312 3.55587,3.63923 4.39707,0.91826 12.99998,-13.80729 27.29704,-26.38931 40.81273,-39.70922 11.18587,-10.57577 22.11229,-21.61254 33.68204,-31.68574 2.68037,-5.20332 5.65074,-10.48469 7.58247,-15.95822 -0.0139,-0.26464 -0.22067,-0.57128 -0.52162,-0.49717 z" id="path15" transform="scale(0.26458333)" />
          <path style="fill:#5a5a5a;fill-opacity:1;stroke-width:0.695489" d="m 373.87303,733.87294 c 0.23448,32.66825 -0.41479,65.37165 0.66289,98.01781 1.55998,-0.18034 1.31604,-3.82882 2.0917,-5.30246 5.9658,-24.50082 12.45581,-48.96989 18.2011,-73.46578 -3.49312,-5.40976 -9.48466,-8.79498 -13.82433,-13.52696 -2.33075,-1.78838 -4.55911,-5.01854 -7.13136,-5.72261 z" id="path16" transform="scale(0.26458333)" />
          <path style="fill:#a1a1a1;fill-opacity:1;stroke-width:0.695489" d="m 370.32087,736.00288 c -5.63418,5.79575 -12.92798,10.27943 -17.31795,17.15767 -1.0599,4.5596 2.22281,8.98848 2.59984,13.49611 5.55461,21.86625 10.71146,43.85306 16.68368,65.61308 1.69524,-1.2061 0.0599,-5.34836 0.69073,-7.45737 0.16637,-30.21456 0.0849,-60.42979 0.10528,-90.64466 -0.93989,-0.65073 -1.93105,1.47476 -2.76158,1.83517 z" id="path17" transform="scale(0.26458333)" />
          <path style="fill:#5a5a5a;fill-opacity:1;stroke-width:0.695489" d="m 269.68412,661.32744 c -1.69423,1.51645 0.948,4.36015 1.27959,6.10455 2.42912,5.37238 4.99781,11.03942 10.12966,14.32521 22.45687,21.33774 44.95895,42.68096 67.17153,64.28545 1.86316,1.43515 2.6837,3.80159 3.96918,5.43351 7.34962,-5.74603 13.92251,-12.76728 20.95025,-19.01321 -5.81859,-4.54551 -12.64869,-8.85998 -18.96159,-13.16132 -2.06977,-1.43668 -4.12882,-2.82184 -5.95513,-4.42424 -10.51322,-6.38183 -20.25292,-14.02731 -30.63005,-20.65684 -3.5869,-2.17623 -6.22125,-5.44291 -10.04656,-7.08122 -3.1525,-1.65453 -5.69376,-4.56194 -8.71671,-6.19692 -1.35449,-0.21415 -1.89026,-2.06117 -3.48152,-2.34049 -8.6881,-5.40868 -16.62685,-11.96672 -25.34597,-17.25818 -0.11887,-0.0286 -0.24195,-0.0294 -0.36268,-0.0163 z" id="path18" transform="scale(0.26458333)" />
          <path style="fill:#b8b8b8;fill-opacity:1;stroke-width:0.695489" d="m 276.80881,599.07843 c -2.12451,1.11965 -0.39916,4.61134 -1.60017,6.51614 -15.48775,43.82664 -31.17434,87.62047 -46.7884,131.41022 -2.76028,8.73417 -6.65125,17.19091 -8.86297,26.04882 1.69586,0.18523 2.00585,-3.50607 3.11466,-4.53054 15.83281,-32.69557 30.9278,-65.74889 46.75138,-98.44534 33.86256,23.26459 67.69817,46.71031 101.55501,69.98632 2.37596,0.35632 -0.1194,-2.86662 -0.22821,-3.7953 -5.02201,-12.88154 -9.51155,-26.04218 -14.52784,-38.8822 -2.69671,-1.64304 -6.14118,-1.87147 -8.57815,-4.1512 -15.84347,-11.8135 -32.21687,-22.98637 -47.65868,-35.30287 -1.48131,-1.27288 -2.77418,-3.22276 -2.27664,-5.06675 -4.89915,1.52052 -9.16183,5.44932 -13.80759,7.80867 -4.44901,2.50339 -9.03792,5.8757 -13.54198,7.704 7.83809,-18.93232 18.08958,-36.88262 25.19926,-56.12544 0.40278,-2.49784 -4.02306,-0.88379 -5.2705,-1.73601 -4.50383,-0.41942 -9.042,-0.78761 -13.47918,-1.43852 z" id="path19" transform="scale(0.26458333)" />
          <path style="fill:#434343;fill-opacity:1;stroke-width:0.695489" d="m 325.46996,594.28472 c -4.83654,1.15573 -9.77881,2.03058 -14.55365,3.19354 -4.68144,2.07588 -10.42588,1.70368 -14.73976,4.50574 -2.20449,9.23704 -7.69777,17.44144 -11.35468,26.19088 -4.2827,9.4652 -8.87716,18.78894 -13.17354,28.2461 1.46337,0.90116 3.74348,-1.96501 5.41356,-2.41248 7.0314,-4.40209 14.62157,-8.28344 21.18689,-13.1981 9.32151,-15.40429 19.63808,-30.31665 28.07289,-46.20103 -0.0203,-0.42803 -0.57864,-0.36855 -0.85171,-0.32465 z" id="path20" transform="scale(0.26458333)" />
          <path style="fill:#414141;fill-opacity:1;stroke-width:0.695489" d="m 268.57568,664.90133 c -3.28275,2.22443 -3.68134,7.08711 -5.79982,10.273 -2.26364,4.26329 -4.07726,9.29904 -6.18107,13.41031 -1.82038,1.17952 -1.45021,4.31078 -2.90707,6.04793 -8.83284,18.87908 -18.17493,37.55025 -26.53169,56.6344 -0.36503,0.87602 -1.81136,1.02372 -1.59609,2.43829 -1.12612,3.81867 -3.87349,7.28578 -4.58996,11.09387 2.00406,-0.0766 2.62493,-3.68574 3.9761,-5.00957 16.52455,-27.43277 33.86241,-54.4756 50.42013,-81.81928 -1.51342,-2.71385 -2.84486,-6.02562 -3.67713,-8.78735 -1.92795,-0.30233 -0.93518,-4.15712 -3.1134,-4.2816 z" id="path21" transform="scale(0.26458333)" />
          <path style="fill:#b8b8b8;fill-opacity:1;stroke-width:0.695489" d="m 276.80881,598.96433 c -1.97497,0.87947 -0.43478,4.08069 -1.69933,5.66036 -10.12704,31.10225 -21.85986,61.66382 -32.57657,92.56859 -7.49917,21.92889 -16.01221,43.49987 -23.05171,65.57507 0.91077,1.65672 2.10844,-1.97428 2.66785,-2.69231 15.59059,-33.0301 31.26638,-66.00977 46.7703,-99.08548 0.83506,-1.33093 2.92116,1.38083 3.98759,1.61809 32.66108,22.20792 64.89433,45.03908 97.63127,67.13211 2.21952,1.57471 1.83888,-1.8979 0.66425,-2.76837 -1.82432,-4.01983 -3.40484,-8.56159 -4.28025,-12.67502 -2.58097,-4.60081 -4.43301,-10.18104 -5.46339,-15.17851 -2.37282,-1.42729 -2.00514,-5.37681 -3.50054,-7.61507 -0.64556,-3.20146 -2.88629,-5.62245 -6.19013,-5.97278 -7.08623,-3.59401 -12.82294,-9.43632 -19.49387,-13.74024 -11.13571,-8.69626 -23.80044,-15.82313 -33.64314,-25.9665 -0.74876,-1.03794 -0.72181,-4.16698 -2.57413,-2.41655 -8.30513,4.49966 -16.67792,10.39724 -24.94524,14.12169 7.25141,-18.59548 17.4963,-35.93821 24.39646,-54.66926 0.36014,-3.1098 -4.43511,-2.12851 -6.27337,-2.66086 -4.15759,-0.33061 -8.32,-0.54094 -12.42605,-1.23496 z" id="path22" transform="scale(0.26458333)" />
          <path style="fill:#898989;fill-opacity:1;stroke-width:0.695489" d="m 117.53361,494.66539 c -0.70275,1.48873 3.07493,2.42233 3.99363,3.56438 19.12877,12.23 38.87874,23.44515 58.12324,35.49696 28.86373,17.34634 57.72056,34.8311 86.47333,52.28275 4.29892,2.71101 6.79615,7.16379 9.29402,11.3506 4.72743,2.5934 10.60083,1.96103 15.82781,2.6991 1.73834,0.57737 5.397,-0.48546 3.28999,-2.72898 -2.41417,-3.13015 -5.06612,-6.38834 -8.86341,-7.48602 -5.69284,-3.24534 -11.67766,-6.48862 -17.26906,-9.65671 -1.47743,-2.16393 -4.82195,-2.11859 -6.76336,-3.95015 -2.25514,-1.11453 -3.6757,-3.24418 -6.18197,-3.72332 -2.69995,-1.22896 -5.49087,-3.00657 -7.59605,-4.7516 -4.69493,-1.05431 -8.63601,-4.8679 -13.07431,-6.84998 -5.45601,-3.49177 -11.9387,-5.8239 -16.82086,-10.00341 -1.2453,-1.17513 -3.65495,-1.13845 -5.04909,-2.54289 -1.55492,-1.83138 -3.5264,-1.69093 -5.51637,-2.99658 -8.15056,-4.7868 -16.99852,-9.01153 -24.54316,-14.51019 -4.38757,-1.41139 -8.69201,-4.37868 -12.50251,-7.09752 -8.58368,-3.94584 -16.74327,-9.05531 -25.00909,-13.70467 -1.42717,-0.86373 -2.26041,-2.49194 -3.96239,-2.30109 -6.99261,-3.45904 -13.34979,-8.08696 -20.2928,-11.48236 -1.11317,-0.61445 -2.2599,-1.47716 -3.55759,-1.60832 z" id="path23" transform="scale(0.26458333)" />
          <path style="fill:#000000;fill-opacity:0;stroke-width:0.695489" d="m 90.007451,476.74975 c -1.153073,1.43784 2.835496,2.34306 3.670458,3.25471 62.711841,35.59915 125.441961,71.15377 188.097981,106.83953 5.56288,3.20926 12.71903,6.11596 14.67506,12.85657 2.23062,1.25312 5.23368,-1.00833 7.66194,-1.04852 7.16424,-2.22402 14.99965,-2.72862 21.82843,-5.82758 1.55419,-2.78277 -2.54866,-4.91676 -4.59132,-5.81793 -76.04076,-36.46747 -152.06809,-72.97305 -228.195189,-109.25702 -1.021058,-0.37144 -2.046961,-0.93011 -3.14736,-0.99976 z" id="path24" transform="scale(0.26458333)" />
          <path style="fill:#b8b8b8;fill-opacity:1;stroke-width:0.695489" d="m 90.007451,476.74975 c -1.153073,1.43784 2.835496,2.34306 3.670458,3.25471 62.711841,35.59915 125.441961,71.15377 188.097981,106.83953 5.56288,3.20926 12.71903,6.11596 14.67506,12.85657 2.23062,1.25312 5.23368,-1.00833 7.66194,-1.04852 7.16424,-2.22402 14.99965,-2.72862 21.82843,-5.82758 1.55419,-2.78277 -2.54866,-4.91676 -4.59132,-5.81793 -76.04076,-36.46747 -152.06809,-72.97305 -228.195189,-109.25702 -1.021058,-0.37144 -2.046961,-0.93011 -3.14736,-0.99976 z" id="path25" transform="scale(0.26458333)" />
          <path style="fill:#d0d0d0;fill-opacity:1;stroke-width:0.695489" d="m 449.47624,642.69865 c -0.83903,1.65998 -0.26602,4.15161 -2.38531,5.26643 -9.1331,7.44522 -18.96541,14.14466 -28.3833,21.14858 -8.02819,5.88274 -15.97014,12.25608 -24.83249,16.98243 -4.83751,0.56538 -4.54273,6.89328 -6.46588,10.21908 -4.01976,10.77374 -8.14567,21.58356 -12.13031,32.32666 -0.19522,2.92141 3.24025,-0.27254 4.11626,-0.78398 31.6298,-21.97313 63.48723,-43.7055 95.10507,-65.72354 1.59821,-0.90755 3.27068,-3.17647 0.90739,-4.36175 -8.84003,-4.65305 -17.15029,-10.42601 -25.93143,-15.07391 z" id="path26" transform="scale(0.26458333)" />
        </g>
      </symbol>
    </defs>
  </svg>

  <!-- Ambient Animated Starfield & Cyber Mesh -->
  <div class="fixed inset-0 pointer-events-none z-0">
    <canvas id="starfield" class="w-full h-full opacity-60"></canvas>
    <div class="absolute inset-0 cyber-grid opacity-60"></div>
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-alien/10 rounded-full blur-[150px]"></div>
    <div class="absolute top-1/2 -right-32 w-[450px] h-[450px] bg-emerald-950/30 rounded-full blur-[160px]"></div>
  </div>

  <div class="relative z-10 flex flex-col min-h-screen">

    @if(session('alert-message'))
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
        <div class="p-4 rounded-xl border border-amber-500/50 bg-void-900/90 text-amber-300 font-mono text-sm flex items-center gap-3 shadow-lg">
          <span class="text-xl">⚠️</span>
          <span>{{ session('alert-message') }}</span>
        </div>
      </div>
    @endif

    <!-- Sticky Navigation Header (Independent Custom Header) -->
    <header class="sticky top-0 z-50 bg-void-950/85 backdrop-blur-xl border-b border-alien/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 gap-4 sm:gap-6">
          
          <!-- Left: Brand -->
          <div class="flex items-center flex-shrink-0">
            <a href="#hero" class="flex items-center gap-3 group">
              <!-- Crest Badge with Official Emblem -->
              <div class="relative w-11 h-11 rounded-xl bg-void-900 border border-slate-700/80 group-hover:border-alien/80 p-1.5 flex items-center justify-center transition-all shadow-md group-hover:shadow-[0_0_15px_rgba(0,255,102,0.3)] flex-shrink-0">
                <svg class="w-full h-full filter drop-shadow-[0_0_4px_rgba(255,255,255,0.4)]" viewBox="0 0 150.15552 134.74237">
                  <use href="#bk-crest-symbol"/>
                </svg>
                <div class="absolute -bottom-1 -right-1 w-2.5 h-2.5 bg-alien rounded-full animate-ping"></div>
              </div>

              <!-- Brand Name & Info -->
              <div class="flex flex-col justify-center">
                <div class="flex items-center gap-2">
                  <span class="font-display font-black tracking-wider text-lg sm:text-xl text-white whitespace-nowrap">
                    @if($effectiveAllianceName === 'Black Knights')
                      BLACK <span class="text-alien">KNIGHTS</span>
                    @else
                      {{ $effectiveAllianceName }}
                    @endif
                  </span>
                  <span class="hidden md:inline-flex text-[10px] font-mono px-2 py-0.5 rounded-full bg-alien/10 text-alien border border-alien/30 whitespace-nowrap">
                    #{{ $effectiveAllianceId }}
                  </span>
                </div>
                <div class="text-[10px] font-mono text-slate-400 tracking-wider uppercase whitespace-nowrap">
                  WORLD'S DANKEST ALLIANCE
                </div>
              </div>
            </a>
          </div>

          <!-- Center: Clean, Spaced Navigation Links -->
          <nav class="hidden lg:flex items-center justify-center gap-6 xl:gap-8 font-mono text-xs uppercase tracking-wider text-slate-300 flex-1 px-4">
            <a href="#lore" class="hover:text-alien transition-colors py-1 whitespace-nowrap">
              Lore &amp; Insignia
            </a>
            <a href="#pillars" class="hover:text-alien transition-colors py-1 whitespace-nowrap">
              Why BK
            </a>
            <a href="#apply-steps" class="text-alien font-semibold hover:text-white transition-colors py-1 whitespace-nowrap flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-alien animate-pulse"></span>
              How to Apply
            </a>
            <a href="#faq" class="hover:text-alien transition-colors py-1 whitespace-nowrap">
              FAQ
            </a>
          </nav>

          <!-- Right: Header Actions -->
          <div class="flex items-center gap-3 flex-shrink-0">
            @auth
              <a href="{{ route('user.dashboard') }}" 
                 class="hidden xl:inline-flex items-center justify-center px-3.5 py-2 rounded-lg text-xs font-mono tracking-wider uppercase text-slate-300 hover:text-white bg-void-850 hover:bg-void-800 border border-slate-700 hover:border-alien/40 transition-all whitespace-nowrap">
                Member Portal
              </a>
            @else
              <a href="{{ route('login') }}" 
                 class="hidden xl:inline-flex items-center justify-center px-3.5 py-2 rounded-lg text-xs font-mono tracking-wider uppercase text-slate-300 hover:text-white bg-void-850 hover:bg-void-800 border border-slate-700 hover:border-alien/40 transition-all whitespace-nowrap">
                Sign In
              </a>
              <a href="{{ $existingMemberRegistrationUrl }}" 
                 class="hidden xl:inline-flex items-center justify-center px-3.5 py-2 rounded-lg text-xs font-mono tracking-wider uppercase text-slate-300 hover:text-white bg-void-850 hover:bg-void-800 border border-slate-700 hover:border-alien/40 transition-all whitespace-nowrap">
                Register as a member
              </a>
            @endauth

            <a href="#apply-steps" 
               class="inline-flex items-center justify-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-xs sm:text-sm font-display font-bold uppercase tracking-wider text-black bg-alien hover:bg-alien-400 alien-glow transition-all transform hover:-translate-y-0.5 active:translate-y-0 whitespace-nowrap shadow-lg">
              <span>Apply Now</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </a>

            <!-- Mobile Toggle Button -->
            <button id="mobileMenuBtn" aria-label="Toggle Menu" class="lg:hidden p-2.5 rounded-lg bg-void-850 border border-alien/20 text-slate-200 hover:text-alien flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobileMenu" class="hidden lg:hidden py-4 border-t border-alien/20 font-mono text-xs space-y-2">
          <a href="#lore" class="block px-3 py-2 rounded hover:bg-alien/10 hover:text-alien">Lore &amp; Insignia</a>
          <a href="#pillars" class="block px-3 py-2 rounded hover:bg-alien/10 hover:text-alien">Why BK</a>
          <a href="#apply-steps" class="block px-3 py-2 rounded bg-alien/15 text-alien font-semibold">How to Apply</a>
          <a href="#faq" class="block px-3 py-2 rounded hover:bg-alien/10 hover:text-alien">FAQ</a>
          <a href="{{ $effectiveDiscordUrl }}" target="_blank" rel="noopener noreferrer" class="block px-3 py-2 rounded text-indigo-400 hover:text-indigo-300 font-semibold border-t border-slate-800/80 pt-2 flex items-center justify-between">
            <span>Join Discord</span>
            <span>↗</span>
          </a>
          @auth
            <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 rounded text-slate-400 hover:text-white">Member Portal ↗</a>
          @else
            <a href="{{ route('login') }}" class="block px-3 py-2 rounded text-slate-400 hover:text-white">Sign In ↗</a>
            <a href="{{ $existingMemberRegistrationUrl }}" class="block px-3 py-2 rounded text-slate-400 hover:text-white">Register as a member ↗</a>
          @endauth
        </div>
      </div>
    </header>

    <main id="main-content" class="flex-grow">

      <!-- Hero Section -->
      <section id="hero" class="relative pt-6 pb-8 lg:pt-10 lg:pb-12 overflow-hidden scroll-mt-24">

        <!-- Decorative Ambient Insignia Watermark in Background -->
        <div class="absolute -top-10 -left-10 sm:left-4 lg:left-8 w-[340px] h-[300px] sm:w-[480px] sm:h-[430px] lg:w-[560px] lg:h-[500px] opacity-[0.06] pointer-events-none select-none -z-10 filter drop-shadow-[0_0_50px_rgba(0,255,102,0.3)]">
          <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
            <use href="#bk-crest-symbol"/>
          </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
            
            <!-- Left Hero Content Column -->
            <div class="lg:col-span-7 text-left space-y-5">
              
              <!-- Status & Official Crest Pill -->
              <div class="flex flex-wrap items-center gap-3">
                @if($recruitmentOpen ?? false)
                  <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-void-900 border border-alien/40 shadow-inner">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-alien opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-alien"></span>
                    </span>
                    <span class="font-mono text-xs text-alien font-semibold tracking-wide">RECRUITMENT TRACTOR BEAM: ONLINE</span>
                  </div>
                @else
                  <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-void-900 border border-red-500/40 shadow-inner">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-60"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                    <span class="font-mono text-xs text-red-400 font-semibold tracking-wide">RECRUITMENT TRACTOR BEAM: OFFLINE</span>
                  </div>
                @endif
              </div>

              <!-- Main Title & Latin Slogan from recruitment flyer -->
              <div class="space-y-3">
                <h1 class="text-4xl sm:text-6xl xl:text-7xl font-display font-black tracking-tight text-white leading-tight uppercase">
                  <span class="sr-only">Apply to {{ $effectiveAllianceName }} - </span>
                  WORLD'S <span class="text-transparent bg-clip-text bg-gradient-to-r from-alien via-emerald-300 to-green-500 neon-text-glow">DANKEST</span> ALLIANCE
                </h1>
                <p class="font-mono text-sm sm:text-base tracking-[0.25em] text-alien uppercase font-bold drop-shadow-[0_0_10px_rgba(0,255,102,0.4)]">
                  NOS SIMILIS NATURALE EIUS DEBENT
                </p>
              </div>

              <!-- Alliance History & Resurgence Pitch -->
              <p class="text-base sm:text-lg text-slate-300 leading-relaxed font-light max-w-2xl">
                Founded in 2014, the <strong class="text-white font-semibold">{{ $effectiveAllianceName }}</strong> are one of the oldest, most storied alliances in Politics &amp; War. We have the battle-tested history, the iconic culture, and now we're rebuilding for our next climb up the global leaderboards. Join a tight-knit community and get in on the ground floor of our resurgence.
              </p>

              <!-- Action Buttons -->
              <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <a href="#apply-steps" 
                   class="px-8 py-4 rounded-xl font-display font-bold text-base tracking-wider uppercase text-black bg-alien hover:bg-alien-400 alien-glow transition-all transform hover:scale-[1.02] active:scale-[0.98] text-center flex items-center justify-center gap-3">
                  <span>Start 3-Step Application</span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                  </svg>
                </a>

                <a href="{{ $effectiveDiscordUrl }}" target="_blank" rel="noopener noreferrer"
                   class="px-6 py-4 rounded-xl font-mono text-sm tracking-wider uppercase text-slate-200 bg-void-850 hover:bg-void-800 border border-slate-700/80 hover:border-alien/60 transition-all flex items-center justify-center gap-3">
                  <svg class="w-5 h-5 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/>
                  </svg>
                  <span>Join Discord Server</span>
                </a>
              </div>

              <!-- Quick Facts Counter Strip -->
              <div class="pt-4 grid grid-cols-3 gap-4 border-t border-slate-800/80">
                <div>
                  <div class="font-display font-bold text-2xl text-white">4,200+</div>
                  <div class="text-xs font-mono text-slate-400 uppercase">Days of Glory</div>
                </div>
                <div>
                  <div class="font-display font-bold text-2xl text-alien">&lt; 24h</div>
                  <div class="text-xs font-mono text-slate-400 uppercase">Review Turnaround</div>
                </div>
                <div>
                  <div class="font-display font-bold text-2xl text-white">BK Net v4</div>
                  <div class="text-xs font-mono text-slate-400 uppercase">Custom Infrastructure</div>
                </div>
              </div>

            </div>

            <!-- Right Hero Column: Interactive Spaceship & Abduction Stage -->
            <div class="lg:col-span-5 relative flex flex-col items-center justify-center">
              
              <!-- Entire Abduction Scene Container -->
              <div class="relative w-full max-w-[480px] min-h-[480px] lg:min-h-[520px] flex flex-col items-center justify-between select-none">
                
                <!-- UFO Spaceship Graphic (Hover Animation) -->
                <div class="relative z-30 w-64 h-24 animate-ufo-hover drop-shadow-[0_0_25px_rgba(0,255,102,0.85)]">
                  <svg viewBox="0 0 240 120" class="w-full h-full">
                    <!-- Glass Cockpit Dome -->
                    <ellipse cx="120" cy="46" rx="44" ry="28" fill="rgba(0, 255, 102, 0.28)" stroke="#00ff66" stroke-width="2.5"/>
                    <ellipse cx="112" cy="38" rx="20" ry="10" fill="rgba(255, 255, 255, 0.45)"/>
                    
                    <!-- Alien Pilot Silhouette inside Cockpit -->
                    <ellipse cx="120" cy="46" rx="10" ry="12" fill="#020408"/>
                    <ellipse cx="116" cy="45" rx="3" ry="2" transform="rotate(-15 116 45)" fill="#00ff66"/>
                    <ellipse cx="124" cy="45" rx="3" ry="2" transform="rotate(15 124 45)" fill="#00ff66"/>

                    <!-- Metallic Saucer Disk Body -->
                    <path d="M18 64 C35 48 205 48 222 64 C236 78 200 88 120 88 C40 88 4 78 18 64 Z" 
                          fill="#0b121e" stroke="#e2e8f0" stroke-width="3"/>
                    
                    <!-- Chrome Rib Lines on Hull -->
                    <path d="M50 64 Q120 74 190 64" fill="none" stroke="#64748b" stroke-width="1.5"/>

                    <!-- Insignia Embossed on Center of Saucer Hull -->
                    <g transform="translate(109.5, 63) scale(0.14)" opacity="0.9" filter="drop-shadow(0 0 3px rgba(0, 255, 102, 0.4))">
                      <use href="#bk-crest-symbol"/>
                    </g>
                    
                    <!-- Neon Underbelly Lights -->
                    <ellipse cx="120" cy="68" rx="84" ry="11" fill="none" stroke="#00ff66" stroke-width="2" stroke-dasharray="10 7"/>
                    
                    <!-- Main Tractor Beam Emitter Lens -->
                    <ellipse cx="120" cy="80" rx="30" ry="9" fill="#00ff66" class="animate-pulse"/>
                    <ellipse cx="120" cy="80" rx="16" ry="5" fill="#ffffff"/>
                  </svg>
                </div>

                <!-- Green Tractor Beam Visual Vector -->
                <div class="absolute top-16 w-72 sm:w-84 h-[400px] z-10 pointer-events-none flex items-center justify-center animate-beam-pulse">
                  <svg viewBox="0 0 320 460" class="w-full h-full overflow-visible">
                    <defs>
                      <linearGradient id="beamGradient" x1="50%" y1="0%" x2="50%" y2="100%">
                        <stop offset="0%" stop-color="#00ff66" stop-opacity="0.9"/>
                        <stop offset="25%" stop-color="#00ff66" stop-opacity="0.55"/>
                        <stop offset="70%" stop-color="#00ff66" stop-opacity="0.22"/>
                        <stop offset="100%" stop-color="#00ff66" stop-opacity="0.02"/>
                      </linearGradient>
                      <radialGradient id="beamAura" cx="50%" cy="0%" r="90%">
                        <stop offset="0%" stop-color="#ffffff" stop-opacity="0.75"/>
                        <stop offset="30%" stop-color="#00ff66" stop-opacity="0.35"/>
                        <stop offset="100%" stop-color="#00ff66" stop-opacity="0"/>
                      </radialGradient>
                    </defs>
                    <!-- Main Trapezoid Beam -->
                    <polygon points="110,0 210,0 315,460 5,460" fill="url(#beamGradient)"/>
                    <polygon points="120,0 200,0 290,460 30,460" fill="url(#beamAura)"/>
                    <!-- Ascending Pulse Ring Particles -->
                    <ellipse cx="160" cy="130" rx="48" ry="11" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.65"/>
                    <ellipse cx="160" cy="240" rx="80" ry="15" fill="none" stroke="#00ff66" stroke-width="1.8" opacity="0.5"/>
                    <ellipse cx="160" cy="360" rx="115" ry="20" fill="none" stroke="#00ff66" stroke-width="2" opacity="0.4"/>
                  </svg>
                </div>

                <!-- Mid-Beam Floating Layer -->
                <div class="relative z-20 w-full flex flex-col items-center justify-center pt-6 animate-float-slow">
                  
                  <!-- Speech Bubble -->
                  <div class="relative z-40 mb-2 filter drop-shadow-[0_0_16px_rgba(0,255,102,0.8)]">
                    <div class="bg-black/95 border-2 border-alien px-4 py-2 rounded-2xl shadow-2xl flex items-center gap-2">
                      <span class="text-alien text-base sm:text-lg animate-bounce">👽</span>
                      <span class="font-mono text-xs sm:text-sm font-bold text-white tracking-wide whitespace-nowrap">
                        lmao wtf im getting abducted
                      </span>
                    </div>
                    <div class="w-0 h-0 border-l-[7px] border-l-transparent border-r-[7px] border-r-transparent border-t-[9px] border-t-alien mx-auto -mt-[1px]"></div>
                  </div>

                  <!-- Person Silhouette Container -->
                  <div id="poseContainer" class="relative w-56 h-40 sm:w-64 sm:h-44 flex items-center justify-center select-none py-1">
                    
                    <!-- POSE 1: Classic Meme Flail -->
                    <svg id="poseFlail" class="w-full h-full drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)] filter transition-transform duration-300 hover:scale-105" viewBox="0 0 240 180" aria-label="Abducted recruit flailing in zero gravity">
                      <g fill="#000000" stroke="#000000">
                        <circle cx="58" cy="52" r="16" stroke="none"/>
                        <line x1="74" y1="67" x2="118" y2="102" stroke-width="24" stroke-linecap="round"/>
                        <polyline points="74,60 52,34 68,14" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="68" cy="14" r="6" stroke="none"/>
                        <polyline points="84,72 110,50 144,40" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="144" cy="40" r="6" stroke="none"/>
                        <polyline points="112,96 148,86 182,58 196,64" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="116,104 134,138 170,146 182,160" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                      </g>

                      <!-- Dropped Smartphone -->
                      <g transform="translate(100, 140) rotate(22)" class="opacity-90">
                        <rect x="-6" y="-12" width="12" height="24" rx="2.5" fill="#0b121e" stroke="#00ff66" stroke-width="1.2"/>
                        <line x1="-3" y1="-8" x2="3" y2="-8" stroke="#00ff66" stroke-width="1"/>
                        <circle cx="0" cy="8" r="1.5" fill="#00ff66"/>
                        <path d="M 8 -8 A 8 8 0 0 1 14 0" fill="none" stroke="#00ff66" stroke-width="1" stroke-dasharray="1 1"/>
                      </g>
                    </svg>

                    <!-- POSE 2: Chill Spacewalk Float -->
                    <svg id="poseChill" class="hidden w-full h-full drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)] filter" viewBox="0 0 240 180" aria-label="Abducted recruit floating peacefully">
                      <g fill="#000000" stroke="#000000">
                        <circle cx="52" cy="74" r="16" stroke="none"/>
                        <line x1="70" y1="78" x2="124" y2="82" stroke-width="24" stroke-linecap="round"/>
                        <polyline points="74,72 100,52 130,50" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="130" cy="50" r="5" stroke="none"/>
                        <polyline points="78,84 102,104 126,108" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="126" cy="108" r="5" stroke="none"/>
                        <polyline points="120,78 156,70 196,68 208,74" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="120,84 154,94 192,102 204,108" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                      </g>
                    </svg>

                    <!-- POSE 3: Knight Salute -->
                    <svg id="poseSalute" class="hidden w-full h-full drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)] filter" viewBox="0 0 240 180" aria-label="Recruit saluting mothership">
                      <g fill="#000000" stroke="#000000">
                        <circle cx="120" cy="38" r="15" stroke="none"/>
                        <line x1="120" y1="58" x2="120" y2="108" stroke-width="24" stroke-linecap="round"/>
                        <polyline points="120,64 92,60 106,38" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="106" cy="38" r="5" stroke="none"/>
                        <polyline points="120,66 142,86 138,110" fill="none" stroke-width="11" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="138" cy="110" r="5" stroke="none"/>
                        <polyline points="114,108 104,138 100,166 94,168" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="126,108 136,138 140,166 146,168" fill="none" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                      </g>
                    </svg>

                  </div>

                  <!-- Interactive Pose Switcher & Status Badge -->
                  <div class="mt-2 flex flex-col items-center gap-1.5">
                    <div class="inline-flex items-center gap-1.5 p-1 rounded-full bg-void-900/90 border border-alien/50 shadow-md">
                      <button onclick="setRecruitPose('flail')" id="btnPoseFlail" class="px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wider uppercase font-bold bg-alien text-black transition-all">
                        Panic
                      </button>
                      <button onclick="setRecruitPose('chill')" id="btnPoseChill" class="px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wider uppercase text-slate-400 hover:text-alien transition-all">
                        Float
                      </button>
                      <button onclick="setRecruitPose('salute')" id="btnPoseSalute" class="px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wider uppercase text-slate-400 hover:text-alien transition-all">
                        Salute
                      </button>
                    </div>

                    @if($recruitmentOpen ?? false)
                      <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-void-900/90 border border-alien/40 shadow-[0_0_12px_rgba(0,255,102,0.3)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-alien animate-ping"></span>
                        <span class="font-mono text-[10px] text-alien font-bold tracking-wider uppercase">
                          NEW RECRUIT &rarr; BK KNIGHT
                        </span>
                      </div>
                    @else
                      <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-void-900/90 border border-red-500/40 shadow-[0_0_12px_rgba(239,68,68,0.25)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        <span class="font-mono text-[10px] text-red-400 font-bold tracking-wider uppercase">
                          TRACTOR BEAM STANDBY
                        </span>
                      </div>
                    @endif
                  </div>

                </div>

                <!-- Ground Teleportation Ring & Aura with Projected Insignia Floor Sigil -->
                <div class="relative z-10 w-full flex flex-col items-center">
                  <div class="relative w-72 h-10 flex items-center justify-center">
                    <div class="w-full h-full bg-alien/20 rounded-[100%] border border-alien/50 blur-[2px] animate-pulse"></div>
                    <div class="absolute inset-x-8 top-1 bottom-1 bg-alien/40 rounded-[100%] blur-[8px]"></div>
                    
                    <!-- Projected Insignia Floor Sigil -->
                    <div class="absolute -top-1.5 w-11 h-10 opacity-50 pointer-events-none filter drop-shadow-[0_0_8px_rgba(0,255,102,0.9)] animate-pulse">
                      <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
                        <use href="#bk-crest-symbol"/>
                      </svg>
                    </div>
                  </div>
                </div>

              </div>

            </div>

          </div>

        </div>
      </section>

      <!-- Section: Official Alliance Flag, Crest & Lore -->
      <section id="lore" class="py-10 lg:py-12 bg-void-900/80 border-y border-alien/15 relative scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left: The Official Metallic Crest Showcase -->
            <div class="lg:col-span-5">
              <div class="glass-panel hud-corner rounded-2xl p-6 sm:p-7 text-center relative overflow-hidden group border-alien/30">
                <div class="absolute top-3 right-3 text-[10px] font-mono text-alien/70 border border-alien/30 px-2 py-0.5 rounded">
                  OFFICIAL CREST
                </div>

                <!-- Large 3D Metallic Emblem Display -->
                <div class="relative py-4 flex items-center justify-center">
                  <div class="absolute w-56 h-40 bg-alien/10 rounded-full blur-[50px] pointer-events-none group-hover:bg-alien/20 transition-all"></div>
                  
                  <div class="w-64 sm:w-72 h-44 relative z-10 transition-transform duration-500 group-hover:scale-105 flex items-center justify-center">
                    <svg class="w-full h-full filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.9)]" viewBox="0 0 150.15552 134.74237">
                      <use href="#bk-crest-symbol"/>
                    </svg>
                  </div>
                </div>

                <!-- Insignia Specs & Description -->
                <div class="border-t border-slate-800 pt-4 text-left space-y-2 font-mono text-xs">
                  <div class="flex items-center justify-between">
                    <span class="text-slate-400">ALLIANCE:</span>
                    <span class="text-white font-bold">{{ $effectiveAllianceName }}</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-slate-400">FOUNDED:</span>
                    <span class="text-alien font-bold">December 12, 2014</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-slate-400">IN-GAME IDENTIFIER:</span>
                    <span class="text-white font-bold">Alliance #{{ $effectiveAllianceId }} (👽)</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-slate-400">RECRUITMENT:</span>
                    <span class="{{ ($recruitmentOpen ?? false) ? 'text-alien font-bold' : 'text-slate-400 font-semibold' }}">
                      {{ ($recruitmentOpen ?? false) ? 'Active Intake' : 'Standby' }}
                    </span>
                  </div>
                </div>

              </div>
            </div>

            <!-- Right: Heritage & Dual Identity Narrative -->
            <div class="lg:col-span-7 space-y-5">
              
              <div class="space-y-1.5">
                <span class="text-xs font-mono uppercase tracking-[0.25em] text-alien font-bold">THE STANDARD &amp; THE MEME</span>
                <h2 class="text-2xl sm:text-4xl font-display font-extrabold text-white uppercase tracking-tight">
                  LEGENDARY HERITAGE. <br><span class="text-alien">UNRIVALED CULTURE.</span>
                </h2>
              </div>

              <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light">
                The <strong class="text-white font-semibold">{{ $effectiveAllianceName }}</strong> carry a storied legacy and a culture unlike any other faction in Politics &amp; War. As one of the longest-standing alliances in the game, we've weathered global wars, leaderboard climbs, and every shifting era in Orbis history. When a nation flies our banner, they enter an ironclad mutual defense pact: no member stands alone, and no raid goes unanswered.
              </p>

              <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light">
                Alongside our battle-tested history, we are the <span class="text-alien font-medium">World's Dankest Alliance</span>: proudly embracing our iconic ayylien culture, tractor-beam abductions, and a tight-knit community where every recruit gets personal war coaching, rapid city grants, and a direct line to leadership rather than getting lost in mega-alliance bureaucracy.
              </p>

              <!-- Motto Strip -->
              <div class="p-3.5 rounded-xl bg-void-950 border border-slate-800 flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-alien/15 border border-alien/40 flex items-center justify-center flex-shrink-0 text-alien text-xl">
                  ⚔️
                </div>
                <div>
                  <div class="text-[11px] font-mono uppercase text-alien tracking-widest font-bold">ALLIANCE MOTTO</div>
                  <div class="text-sm font-mono text-white tracking-wide">"NOS SIMILIS NATURALE EIUS DEBENT"</div>
                </div>
              </div>

            </div>

          </div>

        </div>
      </section>

      <!-- Section: The 3 Core Pillars -->
      <section id="pillars" class="pt-10 pb-4 lg:pt-14 lg:pb-6 bg-void-950 relative scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="text-center max-w-3xl mx-auto mb-8 lg:mb-10">
            <h2 class="font-mono text-xs uppercase tracking-[0.3em] text-alien font-semibold mb-1.5">DO NOT SETTLE FOR BLAND ALLIANCES</h2>
            <p class="text-2xl sm:text-4xl font-display font-extrabold text-white uppercase tracking-tight">
              WHY JOIN THE <span class="text-alien">{{ $effectiveAllianceName }}</span>?
            </p>
            <p class="text-slate-400 mt-2 text-sm sm:text-base">
              The sweet spot between impersonal mega-alliances and fragile micro-alliances.
            </p>
          </div>

          <!-- Cards Grid matching the 3 sections on the poster -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Pillar 1: History & Culture -->
            <div class="glass-panel hud-corner p-6 sm:p-7 rounded-2xl relative overflow-hidden group">
              <div class="w-12 h-12 rounded-xl bg-void-900 border border-slate-700/80 group-hover:border-alien flex items-center justify-center mb-5 p-2 transition-all shadow-md group-hover:shadow-[0_0_18px_rgba(0,255,102,0.4)]">
                <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
                  <use href="#bk-crest-symbol"/>
                </svg>
              </div>

              <h3 class="font-display font-bold text-lg text-white uppercase tracking-wide mb-2.5 flex items-center justify-between">
                <span>History &amp; Culture</span>
                <span class="text-alien/40 text-xs font-mono">01</span>
              </h3>
              <p class="text-slate-300 text-sm leading-relaxed mb-4 font-light">
                "While other alliances fade or rebrand, our history stands on its own. Everyone knows BK. Join us, and soon maybe they'll know your name too."
              </p>
              <div class="pt-3 border-t border-slate-800 text-xs font-mono text-alien/80 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-alien"></span>
                <span>Proven Longevity &amp; Stability</span>
              </div>
            </div>

            <!-- Pillar 2: BK Net Ecosystem -->
            <div class="glass-panel hud-corner p-6 sm:p-7 rounded-2xl relative overflow-hidden group transition-all duration-300 hover:shadow-[0_0_25px_rgba(0,255,102,0.2)]">
              <div class="w-12 h-12 rounded-xl bg-void-900 border border-slate-700/80 group-hover:border-alien flex items-center justify-center mb-5 transition-all shadow-md group-hover:shadow-[0_0_22px_rgba(0,255,102,0.6)]">
                <svg class="w-7 h-7 text-alien animate-radar-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <circle cx="12" cy="12" r="9"/>
                  <circle cx="12" cy="12" r="5" stroke-dasharray="3 3"/>
                  <line x1="12" y1="3" x2="12" y2="12"/>
                  <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                </svg>
              </div>

              <h3 class="font-display font-bold text-lg text-white uppercase tracking-wide mb-2.5 flex items-center justify-between">
                <span>BK Net Portal</span>
                <span class="text-alien/40 group-hover:text-alien/80 transition-colors text-xs font-mono">02</span>
              </h3>
              <p class="text-slate-300 text-sm leading-relaxed mb-4 font-light">
                "We've prioritized cutting-edge tools since day one. With BK Net, access an exclusive web app to request grants, take loans, track your military readiness, and optimize your growth."
              </p>
              <div class="pt-3 border-t border-slate-800 text-xs font-mono text-alien/80 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-alien"></span>
                <span>Automated Grants &amp; Auditing</span>
              </div>
            </div>

            <!-- Pillar 3: Community Support -->
            <div class="glass-panel hud-corner p-6 sm:p-7 rounded-2xl relative overflow-hidden group">
              <div class="w-12 h-12 rounded-xl bg-void-900 border border-slate-700/80 group-hover:border-alien flex items-center justify-center mb-5 transition-all shadow-md group-hover:shadow-[0_0_18px_rgba(0,255,102,0.4)]">
                <svg class="w-7 h-7 text-alien" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 4a3 3 0 100-6 3 3 0 000 6zm-7 5a2.5 2.5 0 100-5 2.5 2.5 0 000 5zm14 0a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM12 9c-3.1 0-6 1.7-6 4v3h12v-3c0-2.3-2.9-4-6-4zm-8 4c-1.8 0-3.5 1-3.5 2.5V18h4v-2.5c0-.9.4-1.8 1.1-2.5H4zm16 0c.7.7 1.1 1.6 1.1 2.5V18h4v-2.5c0-1.5-1.7-2.5-3.5-2.5h-1.6z"/>
                </svg>
              </div>

              <h3 class="font-display font-bold text-lg text-white uppercase tracking-wide mb-2.5 flex items-center justify-between">
                <span>Community Support</span>
                <span class="text-alien/40 text-xs font-mono">03</span>
              </h3>
              <p class="text-slate-300 text-sm leading-relaxed mb-4 font-light">
                "Mega-alliances overlook you, while micro-alliances lack the structure and perks to support you. We hit the sweet spot. We provide top-tier incentives and the personal coaching you need to succeed."
              </p>
              <div class="pt-3 border-t border-slate-800 text-xs font-mono text-alien/80 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-alien"></span>
                <span>Dedicated War Coaching &amp; Build Advice</span>
              </div>
            </div>

          </div>

        </div>
      </section>

      <!-- Section: Perks Summary Grid -->
      <section class="pt-4 pb-10 lg:pt-6 lg:pb-12 bg-void-900/50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="rounded-3xl glass-panel p-6 sm:p-8 border border-alien/30 relative overflow-hidden">
            <!-- Decorative Insignia Watermark in Background -->
            <div class="absolute -right-8 -bottom-8 w-64 h-56 opacity-[0.035] pointer-events-none select-none">
              <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
                <use href="#bk-crest-symbol"/>
              </svg>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6 pb-5 border-b border-slate-800">
              <div>
                <span class="text-xs font-mono uppercase tracking-widest text-alien font-bold">ALLIANCE BENEFITS</span>
                <h3 class="text-xl sm:text-2xl font-display font-bold text-white uppercase mt-1">
                  WHAT YOU RECEIVE AS A FULL MEMBER
                </h3>
              </div>
              <div class="text-xs font-mono text-slate-400 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-alien inline-block"></span>
                <span>Zero Tax Penalties for New Recruits</span>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
              
              <div class="p-4 rounded-xl bg-void-950 border border-slate-800 hover:border-alien/40 transition-colors">
                <div class="text-alien text-xl font-mono mb-1.5">💰 Grants</div>
                <h4 class="font-display font-bold text-sm sm:text-base text-white mb-1">City Expansion Aid</h4>
                <p class="text-xs text-slate-400">Direct cash grants to build your initial cities, infrastructure, and revenue projects rapidly.</p>
              </div>

              <div class="p-4 rounded-xl bg-void-950 border border-slate-800 hover:border-alien/40 transition-colors">
                <div class="text-alien text-xl font-mono mb-1.5">🛡️ Defense</div>
                <h4 class="font-display font-bold text-sm sm:text-base text-white mb-1">Total Raid Protection</h4>
                <p class="text-xs text-slate-400">Attack one Black Knight, attack us all. Any raider or pirate rogue meets swift, overwhelming retaliation.</p>
              </div>

              <div class="p-4 rounded-xl bg-void-950 border border-slate-800 hover:border-alien/40 transition-colors">
                <div class="text-alien text-xl font-mono mb-1.5">⚡ Warfare</div>
                <h4 class="font-display font-bold text-sm sm:text-base text-white mb-1">Automated War Bots</h4>
                <p class="text-xs text-slate-400">Coordinated blitz channels, target assignments, missile defense alarms, and automated battle audits.</p>
              </div>

              <div class="p-4 rounded-xl bg-void-950 border border-slate-800 hover:border-alien/40 transition-colors">
                <div class="text-alien text-xl font-mono mb-1.5">📈 Banking</div>
                <h4 class="font-display font-bold text-sm sm:text-base text-white mb-1">Low-Interest Loans</h4>
                <p class="text-xs text-slate-400">Access liquidity directly from the alliance bank to stockpile munitions or accelerate mega-projects.</p>
              </div>

            </div>
          </div>

        </div>
      </section>

      <!-- Section: 3-Step Application Protocol -->
      <section id="apply-steps" class="py-10 lg:py-14 bg-void-900 relative scroll-mt-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <!-- Protocol Header -->
          <div class="text-center max-w-3xl mx-auto mb-8 lg:mb-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-alien/10 border border-alien/30 font-mono text-xs text-alien uppercase tracking-wider mb-2.5">
              <div class="w-4 h-3.5 flex items-center justify-center flex-shrink-0">
                <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
                  <use href="#bk-crest-symbol"/>
                </svg>
              </div>
              <span>OFFICIAL ONBOARDING PROTOCOL</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-display font-black text-white uppercase tracking-tight">
              <span class="sr-only">Apply to {{ $effectiveAllianceName }} - </span>
              HOW TO <span class="text-alien">APPLY</span> TO {{ $effectiveAllianceName === 'Black Knights' ? 'BK' : $effectiveAllianceName }}
            </h2>
            <div class="mt-3 p-3.5 rounded-xl bg-void-950 border border-alien/30 text-xs sm:text-sm font-mono text-slate-300">
              <span class="text-alien font-bold">Important Notice:</span> Applications start in Politics &amp; War and finish in Discord. You do not need a {{ config('app.name') }} account to apply; the application bot connects your nation ID to your Discord identity.
            </div>
          </div>

          <!-- Step Progression Cards -->
          <div class="space-y-4 sm:space-y-5">

            <!-- Step 1: In-Game Application -->
            <div class="glass-panel rounded-2xl p-5 sm:p-6 border-l-4 border-l-alien transition-all hover:translate-x-1">
              <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                
                <div class="flex items-start gap-4">
                  <div class="w-11 h-11 rounded-xl bg-alien text-black font-display font-black text-lg flex items-center justify-center flex-shrink-0 shadow-[0_0_15px_rgba(0,255,102,0.4)]">
                    01
                  </div>
                  <div>
                    <div class="font-mono text-xs uppercase text-alien font-semibold tracking-wider">Step One</div>
                    <h3 class="text-lg sm:text-xl font-display font-bold text-white uppercase">Become an Applicant In-Game</h3>
                    <p class="text-slate-300 text-sm mt-1 max-w-xl">
                      Navigate to the official Politics &amp; War page for {{ $effectiveAllianceName }} (Alliance ID {{ $effectiveAllianceId }}) and submit your in-game application. Your status will switch to <span class="text-amber-300 font-mono">Applicant</span>.
                    </p>
                  </div>
                </div>

                <div class="flex-shrink-0 flex flex-col items-start md:items-end gap-2">
                  @if($applicationStartUrl)
                    <a href="{{ $applicationStartUrl }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl font-mono text-xs tracking-wider uppercase font-bold text-white bg-void-950 border border-alien/50 hover:bg-alien hover:text-black transition-all shadow-md">
                      <span>Start in Politics &amp; War</span>
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                      </svg>
                    </a>
                    <a href="https://politicsandwar.com/alliance/id={{ $effectiveAllianceId }}" target="_blank" rel="noopener noreferrer"
                       class="text-[11px] font-mono text-slate-400 hover:text-alien transition-colors">
                      View Alliance Page (ID #{{ $effectiveAllianceId }}) &rarr;
                    </a>
                  @elseif(! $applicationsOpen)
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500/10 border border-amber-500/40 font-mono text-xs text-amber-300">
                      <span>Applications are currently paused.</span>
                    </div>
                  @else
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500/10 border border-amber-500/40 font-mono text-xs text-amber-300">
                      <span>Alliance application link is temporarily unavailable.</span>
                    </div>
                  @endif
                </div>

              </div>
            </div>

            <!-- Step 2: Discord Server -->
            <div class="glass-panel rounded-2xl p-5 sm:p-6 border-l-4 border-l-alien transition-all hover:translate-x-1">
              <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                
                <div class="flex items-start gap-4">
                  <div class="w-11 h-11 rounded-xl bg-alien text-black font-display font-black text-lg flex items-center justify-center flex-shrink-0 shadow-[0_0_15px_rgba(0,255,102,0.4)]">
                    02
                  </div>
                  <div>
                    <div class="font-mono text-xs uppercase text-alien font-semibold tracking-wider">Step Two</div>
                    <h3 class="text-lg sm:text-xl font-display font-bold text-white uppercase">Join the Alliance Discord Server</h3>
                    <p class="text-slate-300 text-sm mt-1 max-w-xl">
                      All applicant screening, recruitment questions, and authorization occur in our primary Discord server. Join and follow the welcome directions.
                    </p>
                  </div>
                </div>

                <div class="flex-shrink-0">
                  <a href="{{ $effectiveDiscordUrl }}" target="_blank" rel="noopener noreferrer"
                     class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl font-mono text-xs sm:text-sm tracking-wider uppercase font-bold text-white bg-[#5865F2] hover:bg-[#4752C4] border border-indigo-400/40 transition-all shadow-lg hover:shadow-indigo-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24">
                      <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/>
                    </svg>
                    <span>Join {{ $effectiveAllianceName }} on Discord</span>
                  </a>
                </div>

              </div>
            </div>

            <!-- Step 3: Interactive Slash Command Generator -->
            <div class="glass-panel rounded-2xl p-5 sm:p-6 border-l-4 border-l-alien transition-all hover:translate-x-1">
              <div class="flex items-start gap-4 mb-3">
                <div class="w-11 h-11 rounded-xl bg-alien text-black font-display font-black text-lg flex items-center justify-center flex-shrink-0 shadow-[0_0_15px_rgba(0,255,102,0.4)]">
                  03
                </div>
                <div>
                  <div class="font-mono text-xs uppercase text-alien font-semibold tracking-wider">Step Three</div>
                  <h3 class="text-lg sm:text-xl font-display font-bold text-white uppercase">Run the Discord Bot Slash Command</h3>
                  <p class="text-slate-300 text-sm mt-1 max-w-2xl">
                    Once inside Discord, go to the recruitment channel and run <code class="rounded bg-void-950 border border-slate-700 px-1.5 py-0.5 font-mono text-xs text-alien">/apply nationid:&lt;your nation ID&gt;</code> with your unique numeric Politics &amp; War nation ID.
                  </p>
                </div>
              </div>

              <!-- Interactive Command Generator Box -->
              <div class="mt-4 p-4 sm:p-5 rounded-xl bg-void-950 border border-alien/40 space-y-3">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                  <div class="flex-1">
                    <label for="nationIdInput" class="block font-mono text-xs text-slate-400 uppercase tracking-wider mb-1">
                      Enter your P&amp;W Nation ID (digits only):
                    </label>
                    <input 
                      id="nationIdInput" 
                      type="number" 
                      placeholder="e.g. 123456" 
                      class="w-full bg-void-900 border border-slate-700 focus:border-alien focus:ring-1 focus:ring-alien rounded-lg px-3.5 py-2.5 text-white font-mono text-sm outline-none transition-all placeholder:text-slate-600"
                    />
                  </div>
                  
                  <div class="sm:self-end">
                    <button 
                      id="copyCommandBtn"
                      class="w-full sm:w-auto px-5 py-2.5 rounded-lg font-mono text-xs uppercase tracking-wider font-bold bg-alien hover:bg-alien-400 text-black flex items-center justify-center gap-2 transition-all active:scale-95 shadow-[0_0_12px_rgba(0,255,102,0.3)]">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                      </svg>
                      <span id="copyBtnText">Copy Command</span>
                    </button>
                  </div>
                </div>

                <!-- Live Command Output Display -->
                <div class="flex items-center justify-between px-3.5 py-2.5 bg-void-900/90 rounded-lg border border-slate-800 font-mono text-sm overflow-x-auto">
                  <div class="flex items-center gap-2 text-slate-300 whitespace-nowrap">
                    <span class="text-alien select-none">$</span>
                    <span class="text-indigo-400 font-semibold select-none">/apply</span>
                    <span class="text-slate-400">nationid:</span>
                    <span id="commandPreview" class="text-alien font-bold">123456</span>
                  </div>
                  <span class="text-[11px] text-slate-500 font-mono uppercase tracking-wider hidden sm:inline-block">Paste into Discord</span>
                </div>

                <!-- Live Feedback Toast -->
                <div id="copyToast" class="hidden text-xs font-mono text-alien flex items-center gap-1.5 transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                  <span>Command copied to clipboard! Paste it in Discord.</span>
                </div>

              </div>

            </div>

          </div>

          <!-- Interview Process Clarification -->
          <div class="mt-5 glass-panel rounded-2xl p-5 sm:p-6 border border-slate-800">
            <h4 class="font-display font-bold text-base sm:text-lg text-white uppercase tracking-wide flex items-center gap-2 mb-2">
              <span class="w-2.5 h-2.5 rounded-full bg-alien inline-block"></span>
              Applicant Interview &amp; Status Tracking
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-300 leading-relaxed font-light">
              <p>
                Once you run the <span class="font-mono text-alien">/apply</span> command, our Discord bot automatically provisions a private channel for your interview. A recruitment officer will greet you and ask standard background questions.
              </p>
              <div>
                <p class="mb-1.5">
                  You can check your application status at any time in Discord with:
                </p>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-void-950 border border-slate-700 font-mono text-xs text-alien">
                  <span>/applications status</span>
                </div>
                <p class="text-xs text-slate-400 mt-1.5">
                  Once approved, your in-game application is accepted, and full member permissions unlock immediately.
                </p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- Section: Clearance Requirements, Published Policy & FAQ Accordion -->
      <section id="faq" class="py-10 lg:py-14 bg-void-950 relative scroll-mt-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="text-center max-w-2xl mx-auto mb-8 lg:mb-10">
            <span class="text-xs font-mono uppercase tracking-widest text-alien font-bold">CLEARANCE STANDARDS</span>
            <h2 class="text-2xl sm:text-4xl font-display font-extrabold text-white uppercase tracking-tight mt-1">
              REQUIREMENTS &amp; FAQ
            </h2>
            <p class="text-slate-400 text-sm mt-1.5">Essential guidelines before stepping into the tractor beam.</p>
          </div>

          <!-- 3 Quick Requirement Badges -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8 lg:mb-10">
            
            <div class="glass-panel p-5 rounded-xl border border-slate-800">
              <div class="text-alien text-sm font-mono font-bold mb-1">01 // NO ACTIVE ROGUE WARS</div>
              <h4 class="font-display font-bold text-white text-base mb-1">Peaceful Standing</h4>
              <p class="text-xs text-slate-400">Must not currently be engaged in unauthorized offensive wars or under hostile rogue bounties.</p>
            </div>

            <div class="glass-panel p-5 rounded-xl border border-slate-800">
              <div class="text-alien text-sm font-mono font-bold mb-1">02 // GAME ACTIVITY</div>
              <h4 class="font-display font-bold text-white text-base mb-1">Daily Logins</h4>
              <p class="text-xs text-slate-400">P&amp;W is a daily turn-based game. We expect regular logins to collect taxes and maintain readiness.</p>
            </div>

            <div class="glass-panel p-5 rounded-xl border border-slate-800">
              <div class="text-alien text-sm font-mono font-bold mb-1">03 // DISCORD PRESENCE</div>
              <h4 class="font-display font-bold text-white text-base mb-1">Active Discord</h4>
              <p class="text-xs text-slate-400">Discord is our central communication center for banking grants, announcements, and defense pings.</p>
            </div>

          </div>

          @if(filled($content))
            <!-- Published Requirements from CMS -->
            <div class="glass-panel hud-corner rounded-2xl p-6 sm:p-7 border border-alien/40 mb-8 text-left">
              <div class="flex items-center gap-2 mb-4">
                <span class="w-2 h-2 rounded-full bg-alien inline-block"></span>
                <span class="text-xs font-mono uppercase tracking-widest text-alien font-bold">PUBLISHED REQUIREMENTS &amp; POLICY</span>
              </div>
              <div class="prose prose-invert max-w-none text-sm text-slate-300 font-light space-y-3 leading-relaxed">
                {!! $content !!}
              </div>
            </div>
          @endif

          <!-- FAQ Accordion -->
          <div class="space-y-3">
            
            <!-- FAQ 1 -->
            <div class="faq-item glass-panel rounded-xl border border-slate-800 overflow-hidden">
              <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between text-white font-display font-bold text-base hover:text-alien transition-colors">
                <span>Do I need to sign up for a {{ config('app.name') }} account first?</span>
                <svg class="faq-arrow w-5 h-5 text-alien transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="faq-content hidden px-6 pb-5 text-sm text-slate-300 font-light border-t border-slate-800/60 pt-3">
                No. As stated above, you do <strong class="text-alien">not</strong> need an existing web account. Our Discord recruitment bot connects your nation ID to your Discord identity. Once accepted, your member portal access is provisioned automatically.
              </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item glass-panel rounded-xl border border-slate-800 overflow-hidden">
              <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between text-white font-display font-bold text-base hover:text-alien transition-colors">
                <span>How fast is the applicant interview?</span>
                <svg class="faq-arrow w-5 h-5 text-alien transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="faq-content hidden px-6 pb-5 text-sm text-slate-300 font-light border-t border-slate-800/60 pt-3">
                Our recruiter officers cover global timezones. Turnaround typically takes just a few hours and almost always under 24 hours. Keep notifications enabled in Discord so you can answer when a recruiter pings you.
              </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item glass-panel rounded-xl border border-slate-800 overflow-hidden">
              <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between text-white font-display font-bold text-base hover:text-alien transition-colors">
                <span>I'm a brand new player. Can I still join {{ $effectiveAllianceName }}?</span>
                <svg class="faq-arrow w-5 h-5 text-alien transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="faq-content hidden px-6 pb-5 text-sm text-slate-300 font-light border-t border-slate-800/60 pt-3">
                Yes! We take pride in training new rulers. You'll receive starter city expansion grants, defense from day one, and access to build calculators and war academies to make your nation competitive quickly.
              </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item glass-panel rounded-xl border border-slate-800 overflow-hidden">
              <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between text-white font-display font-bold text-base hover:text-alien transition-colors">
                <span>What if I am already an approved member?</span>
                <svg class="faq-arrow w-5 h-5 text-alien transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="faq-content hidden px-6 pb-5 text-sm text-slate-300 font-light border-t border-slate-800/60 pt-3">
                @auth
                  Your account is already set up. Open the <a href="{{ route('user.dashboard') }}" class="text-alien underline hover:text-white font-semibold">member app</a> to continue.
                @else
                  If you have already gone through recruitment and your nation was accepted into {{ $effectiveAllianceName }}, you do not need to apply again. You can <a href="{{ route('login') }}" class="text-alien underline hover:text-white">sign in</a> or <a href="{{ $existingMemberRegistrationUrl }}" class="text-alien underline hover:text-white font-semibold">Register as a member</a>.
                @endauth
              </div>
            </div>

          </div>

        </div>
      </section>

      <!-- Final Call to Action Section -->
      <section class="py-10 lg:py-12 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
          
          <div class="glass-panel hud-corner rounded-3xl p-8 sm:p-10 text-center border border-alien/50 relative shadow-[0_0_40px_rgba(0,255,102,0.15)]">
            <div class="absolute inset-0 bg-radial-at-c from-alien/15 via-transparent to-transparent pointer-events-none"></div>

            <!-- Centered Emblem Icon -->
            <div class="w-16 h-14 mx-auto mb-3 flex items-center justify-center">
              <svg class="w-full h-full filter drop-shadow-[0_0_12px_rgba(0,255,102,0.6)]" viewBox="0 0 150.15552 134.74237">
                <use href="#bk-crest-symbol"/>
              </svg>
            </div>

            <h2 class="text-2xl sm:text-4xl font-display font-black text-white uppercase tracking-tight">
              STEP INTO THE TRACTOR BEAM
            </h2>
            <p class="font-mono text-sm text-alien tracking-widest uppercase mt-1.5">
              NOS SIMILIS NATURALE EIUS DEBENT
            </p>
            <p class="text-slate-300 max-w-xl mx-auto mt-3 text-sm sm:text-base font-light">
              Claim your place in one of Orbis's greatest alliances. Submit your in-game application and initiate onboarding in Discord today.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3.5">
              <a href="#apply-steps" 
                 class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-display font-bold text-sm sm:text-base uppercase tracking-wider text-black bg-alien hover:bg-alien-400 alien-glow transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                <span>Start Application</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </a>

              <a href="{{ $effectiveDiscordUrl }}" target="_blank" rel="noopener noreferrer"
                 class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-mono text-xs uppercase tracking-wider text-slate-300 bg-void-950 border border-slate-700 hover:border-alien/60 transition-all flex items-center justify-center gap-2">
                <svg class="w-4 h-4 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028 14.09 14.09 0 0 0 1.226-1.994.076.076 0 0 0-.041-.106 13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/>
                </svg>
                <span>Recruiter Discord</span>
              </a>
            </div>

          </div>

        </div>
      </section>

    </main>

    <!-- Footer (Independent Custom Footer) -->
    <footer class="bg-void-950/85 backdrop-blur-xl border-t border-slate-800/80 py-6 sm:py-8 text-xs font-mono text-slate-400">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
          <div class="flex items-center gap-3">
            <!-- Mini Logo -->
            <div class="w-7 h-6 flex items-center justify-center">
              <svg class="w-full h-full" viewBox="0 0 150.15552 134.74237">
                <use href="#bk-crest-symbol"/>
              </svg>
            </div>
            <span class="font-display font-black text-white text-base">{{ $effectiveAllianceName }}</span>
            <span class="text-alien">///</span>
            <span>POLITICS &amp; WAR #{{ $effectiveAllianceId }}</span>
          </div>

          <div class="flex flex-wrap items-center justify-center gap-6 text-slate-400">
            <a href="https://politicsandwar.com/alliance/id={{ $effectiveAllianceId }}" target="_blank" rel="noopener noreferrer" class="hover:text-alien transition-colors">P&amp;W Alliance #{{ $effectiveAllianceId }}</a>
            <a href="{{ $effectiveDiscordUrl }}" target="_blank" rel="noopener noreferrer" class="hover:text-alien transition-colors">Discord Server</a>
            @auth
              <a href="{{ route('user.dashboard') }}" class="hover:text-alien transition-colors">Member Portal</a>
            @else
              <a href="{{ route('login') }}" class="hover:text-alien transition-colors">Member Sign In</a>
            @endauth
            <a href="#hero" class="hover:text-alien transition-colors">Back to Top ↑</a>
          </div>

          <div class="text-slate-500 text-center md:text-right">
            &copy; 2014 - {{ date('Y') }} {{ $effectiveAllianceName }}. All rights reserved.
          </div>
        </div>

      </div>
    </footer>

  </div>

  <script>
    // Starfield Particle Canvas Generator
    (function initStarfield() {
      const canvas = document.getElementById('starfield');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      let stars = [];
      let width = 0;
      let height = 0;

      function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        stars = [];
        const count = Math.floor((width * height) / 4500);
        for (let i = 0; i < count; i++) {
          stars.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 1.3,
            alpha: Math.random() * 0.8 + 0.2,
            speed: Math.random() * 0.25 + 0.05
          });
        }
      }

      function draw() {
        ctx.clearRect(0, 0, width, height);
        for (let i = 0; i < stars.length; i++) {
          const star = stars[i];
          ctx.beginPath();
          ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
          ctx.fillStyle = `rgba(0, 255, 102, ${star.alpha})`;
          ctx.fill();

          // Gentle upward drift
          star.y -= star.speed;
          if (star.y < 0) {
            star.y = height;
            star.x = Math.random() * width;
          }
        }
        requestAnimationFrame(draw);
      }

      window.addEventListener('resize', resize);
      resize();
      draw();
    })();

    // Interactive Discord Slash Command Generator
    const nationIdInput = document.getElementById('nationIdInput');
    const commandPreview = document.getElementById('commandPreview');
    const copyCommandBtn = document.getElementById('copyCommandBtn');
    const copyBtnText = document.getElementById('copyBtnText');
    const copyToast = document.getElementById('copyToast');

    function updatePreview() {
      const val = nationIdInput ? nationIdInput.value.trim() : '';
      if (commandPreview) {
        commandPreview.textContent = val.length > 0 ? val : '123456';
      }
    }

    if (nationIdInput) {
      nationIdInput.addEventListener('input', updatePreview);
    }

    if (copyCommandBtn) {
      copyCommandBtn.addEventListener('click', function() {
        const idVal = (nationIdInput ? nationIdInput.value.trim() : '') || '123456';
        const fullCommand = `/apply nationid:${idVal}`;

        try {
          if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(fullCommand).then(showCopiedFeedback).catch(() => fallbackCopy(fullCommand));
          } else {
            fallbackCopy(fullCommand);
          }
        } catch (err) {
          fallbackCopy(fullCommand);
        }
      });
    }

    function fallbackCopy(text) {
      try {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        showCopiedFeedback();
      } catch (err) {
        console.error('Failed to copy: ', err);
      }
    }

    function showCopiedFeedback() {
      if (copyBtnText) copyBtnText.textContent = 'Copied!';
      if (copyToast) copyToast.classList.remove('hidden');
      setTimeout(() => {
        if (copyBtnText) copyBtnText.textContent = 'Copy Command';
        if (copyToast) copyToast.classList.add('hidden');
      }, 3500);
    }

    // Interactive Abduction Pose Switcher
    function setRecruitPose(pose) {
      const poses = {
        flail: document.getElementById('poseFlail'),
        chill: document.getElementById('poseChill'),
        salute: document.getElementById('poseSalute')
      };
      const btns = {
        flail: document.getElementById('btnPoseFlail'),
        chill: document.getElementById('btnPoseChill'),
        salute: document.getElementById('btnPoseSalute')
      };

      Object.keys(poses).forEach(key => {
        if (poses[key]) poses[key].classList.add('hidden');
        if (btns[key]) {
          btns[key].className = 'px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wider uppercase text-slate-400 hover:text-alien transition-all';
        }
      });

      if (poses[pose]) poses[pose].classList.remove('hidden');
      if (btns[pose]) {
        btns[pose].className = 'px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wider uppercase font-bold bg-alien text-black transition-all';
      }
    }
    window.setRecruitPose = setRecruitPose;

    // FAQ Accordion Toggle Logic
    document.querySelectorAll('.faq-toggle').forEach(button => {
      button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        const arrow = button.querySelector('.faq-arrow');
        const isHidden = content.classList.contains('hidden');

        // Close other FAQ items
        document.querySelectorAll('.faq-content').forEach(item => item.classList.add('hidden'));
        document.querySelectorAll('.faq-arrow').forEach(arr => arr.classList.remove('rotate-180'));

        if (isHidden) {
          content.classList.remove('hidden');
          arrow.classList.add('rotate-180');
        }
      });
    });

    // Mobile Navigation Drawer Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });

      mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          mobileMenu.classList.add('hidden');
        });
      });
    }
  </script>
</body>
</html>
