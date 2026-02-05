@extends('layouts.main')

@section('title', 'Mamography Analyzer')

@section('content')

@php
    // ensure $testimonials is defined and convert to a simple array for JS
    $testimonials = $testimonials ?? collect();
    $testimonialsArr = $testimonials->map(function($t) {
        return [
            'id' => $t->id ?? null,
            'name' => $t->name ?? '',
            'role' => $t->role ?? '',
            'text' => $t->text ?? '',
            'img' => $t->avatar ?? '/images/profile1.png',
        ];
    })->toArray();

    $first = $testimonials->first();
@endphp

    {{-- HERO – nadpis + vlna --}}
    <section class="hero-blob">
        <div class="hero-heading">
            <h1 class="hero-title">
                Mamography<br>
                Analyzer
            </h1>
        </div>

        <div class="hero-wave-box">
            <div class="hero-wave">
                <svg viewBox="0 0 1200 300" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="g1" x1="0" x2="1">
                            <stop offset="0%" stop-color="#9c0b8e"/>
                            <stop offset="100%" stop-color="#d04fa7"/>
                        </linearGradient>
                    </defs>

                    <path d="M0,120 C150,200 350,0 600,80 C850,160 1050,60 1200,120 L1200,300 L0,300 Z"
                          fill="url(#g1)"/>
                    <path d="M0,140 C180,80 380,200 620,150 C860,100 980,220 1200,140 L1200,300 L0,300 Z"
                          fill="#f0e8f6" opacity="0.5"/>
                </svg>
            </div>

            <div class="hero-inner">
                <p class="hero-sub">
                    Bezpečnostná podpora umelej inteligencie pre detekciu rakoviny prsníka
                </p>
                <a href="{{ route('skrining') }}" class="hero-btn">Viac informácií</a>
            </div>
        </div>
    </section>

        {{-- TESTIMONIAL – doktor, so šípkami po bokoch --}}
    <section class="testimonial-wrapper">
        <div class="testimonial-card">
            <button class="testimonial-nav-btn" id="prevTest">&lsaquo;</button>

            <div class="testimonial-main">
                <div class="testimonial-photo">
                    <img id="testImage" src="{{ $first ? ($first->avatar ?? '/images/profile1.png') : '/images/profile1.png' }}" alt="profil lekára">
                </div>
                <div class="testimonial-meta">
                    <div id="testName" class="testimonial-name">{{ $first ? $first->name : 'MUDr. Ivana Lucka' }}</div>
                    <div id="testRole" class="testimonial-role">{{ $first ? $first->role : 'Primárka rádiológie, Trnava' }}</div>
                    <p id="testText" class="testimonial-text">{{ $first ? $first->text : '„Mamografický analyzer mi pomohol rýchlo nájsť suspektné ložiská a zlepšil workflow.“' }}</p>
                </div>
            </div>

            <button class="testimonial-nav-btn" id="nextTest">&rsaquo;</button>
        </div>
    </section>

    {{-- INFO O MAMOGRAFII --}}
    <section class="intro-section">
        <h2>Čo je mamografia a prečo je dôležitá?</h2>
        <p>
            Mamografia je röntgenové vyšetrenie prsníkov, ktoré dokáže zachytiť drobné zmeny v tkanive
            ešte predtým, než sú hmatné alebo spôsobujú príznaky. Pravidelný skríning pomáha odhaliť
            nádory v skorom štádiu, keď je liečba jednoduchšia a úspešnejšia. AI nástroje, ako tento
            mamografický analyzer, dokážu lekára upozorniť na podozrivé ložiská a znížiť riziko
            prehliadnutia.
        </p>
    </section>

    {{-- INFO O MAMOGRAFII -- end --}}


    {{-- MAMMOGRAM THUMBS --}}
    <section class="thumb-section">
        <div class="thumb-grid">
            <article class="thumb-card thumb-card-softPink">
                <div class="thumb-image">
                    <img src="/images/mammo1.png" alt="mamogram">
                </div>
                <div class="thumb-label">9,4 % – nález</div>
            </article>

            <article class="thumb-card">
                <div class="thumb-image">
                    <img src="/images/mammo2.png" alt="mamogram">
                </div>
                <div class="thumb-label">ROI view</div>
            </article>

            <article class="thumb-card thumb-card-pink">
                <div class="thumb-image">
                    <img src="/images/mammo3.png" alt="mamogram">
                </div>
                <div class="thumb-label">25 % výsledok AI</div>
            </article>
        </div>
    </section>


    {{-- Webináre (inline - moved from partial) --}}

    <section class="more-section webinars-section">
        <h3>Najbližšie webináre</h3>

        @if(isset($webinars) && $webinars->count())
            <div class="more-grid more-grid--stacked">
                @foreach($webinars as $w)
                    <article class="more-card">
                        <div>
                            <h4 class="more-card-title">{{ $w->title }}</h4>
                            <p class="more-tag">{{ $w->date->format('d.m.Y H:i') }}</p>
                            <p class="more-card-text">{{ \Illuminate\Support\Str::limit($w->short_text, 140) }}</p>
                            <p class="more-meta">Miesto: {{ $w->location ?? 'Miesto neuvedené' }}</p>
                            @if($w->telephone)
                                <p class="more-meta">Kontakt: {{ $w->telephone }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="table-container" style="padding:1.25rem; text-align:center;">
                <p>Nie sú žiadne webináre.</p>
            </div>
        @endif
    </section>

    {{-- ZISTITE VIAC --}}
    <section class="more-section" style="padding-bottom: 60px;">
        <h3>Zistite viac</h3>

        <div class="more-grid">
            <article class="more-card">
                <div>
                    <div class="more-tag">Konferencia</div>
                    <h4 class="more-card-title">BBI 2023</h4>
                    <p class="more-card-text">
                        Krátky popis konferencie alebo odkazu – napríklad výsledky, nové odporúčania
                        a skúsenosti z praxe.
                    </p>
                </div>
                <a href="#" class="more-card-link">
                    Viac
                    <span>›</span>
                </a>
            </article>

            <article class="more-card">
                <div>
                    <div class="more-tag">Výskum</div>
                    <h4 class="more-card-title">AI v mamografii</h4>
                    <p class="more-card-text">
                        Popis výskumu, publikácie alebo čl��nku o tom, ako AI zlepšuje citlivosť a
                        znižuje počet zbytočných vyšetrení.
                    </p>
                </div>
                <a href="#" class="more-card-link">
                    Viac
                    <span>›</span>
                </a>
            </article>

            <article class="more-card">
                <div>
                    <div class="more-tag">Regulácia</div>
                    <h4 class="more-card-title">Regulácia &amp; FDA</h4>
                    <p class="more-card-text">
                        Informácie o schvaľovaní, certifikácii a požiadavkách na AI nástroje v mamografii.
                    </p>
                </div>
                <a href="#" class="more-card-link">
                    Viac
                    <span>›</span>
                </a>
            </article>
        </div>
    </section>



@endsection

@section('scripts')
    <script>
        const testimonials = @json($testimonialsArr);

        let idx = 0;
        const imgEl  = document.getElementById('testImage');
        const nameEl = document.getElementById('testName');
        const roleEl = document.getElementById('testRole');
        const textEl = document.getElementById('testText');

        function renderTest(i) {
            if (!testimonials || !testimonials.length) return;
            const t = testimonials[i];
            if (imgEl) imgEl.src = t.img || '/images/profile1.png';
            if (nameEl) nameEl.textContent = t.name || '';
            if (roleEl) roleEl.textContent = t.role || '';
            if (textEl) textEl.textContent = t.text || '';
        }

        document.getElementById('prevTest')?.addEventListener('click', () => {
            if (!testimonials.length) return;
            idx = (idx - 1 + testimonials.length) % testimonials.length;
            renderTest(idx);
        });

        document.getElementById('nextTest')?.addEventListener('click', () => {
            if (!testimonials.length) return;
            idx = (idx + 1) % testimonials.length;
            renderTest(idx);
        });

        if (testimonials.length) renderTest(0);
    </script>
@endsection
