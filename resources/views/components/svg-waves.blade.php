@php
    $waveClass = $attributes->get('class') ?? \App\Helpers\PageHelper::getWaveClass();
@endphp

<svg class="waves-footer {{ $waveClass }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
    style="width: 100%; height: auto; display: block;">
    <defs>
        <linearGradient id="footerGradient" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#14532d;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#22c55e;stop-opacity:1" />
        </linearGradient>
    </defs>
    <path fill="url(#footerGradient)" fill-opacity="1"
        d="M0,32L26.7,42.7C53.3,53,107,75,160,106.7C213.3,139,267,181,320,170.7C373.3,160,427,96,480,96C533.3,96,587,160,640,186.7C693.3,213,747,203,800,192C853.3,181,907,171,960,144C1013.3,117,1067,75,1120,80C1173.3,85,1227,139,1280,154.7C1333.3,171,1387,149,1413,138.7L1440,128L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
    </path>
</svg>
