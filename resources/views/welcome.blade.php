<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0a0a0f;
            --paper: #f5f2eb;
            --gold: #c9a84c;
            --gold-light: #e8cc7e;
            --mist: #8b8b9a;
            --card-bg: #13131a;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--ink);
            color: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            overflow-x: hidden;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }

        /* ── GLOW ORBS ── */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
            animation: drift 20s ease-in-out infinite alternate;
        }
        .orb-1 { width: 600px; height: 600px; background: #c9a84c; top: -200px; right: -100px; animation-delay: 0s; }
        .orb-2 { width: 400px; height: 400px; background: #4c6bc9; bottom: 100px; left: -150px; animation-delay: -7s; }
        .orb-3 { width: 300px; height: 300px; background: #c94c8a; top: 50%; left: 40%; animation-delay: -14s; opacity: 0.1; }

        @keyframes drift {
            0%   { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -60px) scale(1.15); }
        }

        /* ── NAVBAR ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 24px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to bottom, rgba(10,10,15,0.95), transparent);
            backdrop-filter: blur(2px);
            animation: fadeDown 0.8s ease both;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: var(--paper);
            text-decoration: none;
        }

        .nav-logo span { color: var(--gold); }

        .nav-links { display: flex; align-items: center; gap: 12px; }

        .nav-link {
            color: var(--mist);
            text-decoration: none;
            font-size: 0.9rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 8px 16px;
            border-radius: 6px;
            transition: color 0.3s, background 0.3s;
        }
        .nav-link:hover { color: var(--paper); background: rgba(255,255,255,0.06); }

        .nav-cta {
            color: var(--ink);
            background: var(--gold);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 10px 22px;
            border-radius: 6px;
            transition: background 0.3s, transform 0.2s;
        }
        .nav-cta:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
        }

        .hero-inner { max-width: 820px; }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 32px;
            animation: fadeUp 0.8s 0.2s ease both;
        }

        .eyebrow-line {
            width: 40px;
            height: 1px;
            background: var(--gold);
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3.5rem, 8vw, 7rem);
            font-weight: 300;
            line-height: 1.05;
            letter-spacing: -0.01em;
            color: var(--paper);
            margin-bottom: 28px;
            animation: fadeUp 0.8s 0.35s ease both;
        }

        .hero-title em {
            font-style: italic;
            color: var(--gold);
        }

        .hero-subtitle {
            font-size: 1.05rem;
            color: var(--mist);
            line-height: 1.75;
            max-width: 520px;
            margin: 0 auto 52px;
            animation: fadeUp 0.8s 0.5s ease both;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp 0.8s 0.65s ease both;
        }

        .btn-primary {
            display: inline-block;
            background: var(--gold);
            color: var(--ink);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 16px 40px;
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 8px 32px rgba(201,168,76,0.25);
        }
        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 16px 48px rgba(201,168,76,0.35);
        }

        .btn-secondary {
            display: inline-block;
            border: 1px solid rgba(245,242,235,0.2);
            color: var(--paper);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 16px 40px;
            border-radius: 8px;
            transition: border-color 0.3s, background 0.3s, transform 0.2s;
        }
        .btn-secondary:hover {
            border-color: rgba(245,242,235,0.5);
            background: rgba(245,242,235,0.05);
            transform: translateY(-2px);
        }

        /* scroll indicator */
        .scroll-hint {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            animation: fadeUp 1s 1s ease both;
        }
        .scroll-hint span {
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--mist);
        }
        .scroll-mouse {
            width: 22px; height: 36px;
            border: 1.5px solid rgba(139,139,154,0.4);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            padding-top: 6px;
        }
        .scroll-wheel {
            width: 3px; height: 7px;
            background: var(--gold);
            border-radius: 2px;
            animation: scrollWheel 1.8s ease-in-out infinite;
        }
        @keyframes scrollWheel {
            0%   { transform: translateY(0); opacity: 1; }
            80%  { transform: translateY(10px); opacity: 0; }
            100% { transform: translateY(0); opacity: 0; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── DIVIDER ── */
        .divider {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 48px;
            margin: 0 auto;
            max-width: 900px;
        }
        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201,168,76,0.3), transparent);
        }
        .divider-icon {
            margin: 0 24px;
            font-size: 1.4rem;
            opacity: 0.5;
        }

        /* ── FEATURES ── */
        .features {
            position: relative;
            z-index: 1;
            padding: 100px 48px;
        }

        .features-header {
            text-align: center;
            margin-bottom: 72px;
            animation: fadeUp 0.8s ease both;
        }

        .section-label {
            display: inline-block;
            font-size: 0.7rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 300;
            color: var(--paper);
            line-height: 1.2;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            padding: 40px 36px;
            position: relative;
            overflow: hidden;
            transition: transform 0.4s, border-color 0.4s, box-shadow 0.4s;
            animation: fadeUp 0.8s ease both;
        }
        .feature-card:nth-child(2) { animation-delay: 0.12s; }
        .feature-card:nth-child(3) { animation-delay: 0.24s; }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
            opacity: 0;
            transition: opacity 0.4s;
        }
        .feature-card:hover { transform: translateY(-6px); border-color: rgba(201,168,76,0.2); box-shadow: 0 24px 60px rgba(0,0,0,0.4); }
        .feature-card:hover::before { opacity: 1; }

        .feature-glyph {
            width: 52px; height: 52px;
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 24px;
        }

        .feature-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--paper);
            margin-bottom: 12px;
        }

        .feature-desc {
            font-size: 0.92rem;
            color: var(--mist);
            line-height: 1.7;
        }

        /* ── CTA BANNER ── */
        .cta-banner {
            position: relative;
            z-index: 1;
            margin: 0 48px 80px;
            border-radius: 20px;
            padding: 80px 48px;
            text-align: center;
            background: linear-gradient(135deg, #1a1610 0%, #0f1320 50%, #1a1610 100%);
            border: 1px solid rgba(201,168,76,0.2);
            overflow: hidden;
        }
        .cta-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%, rgba(201,168,76,0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
            color: var(--paper);
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .cta-subtitle {
            color: var(--mist);
            font-size: 1rem;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .cta-banner .btn-primary {
            position: relative;
            z-index: 1;
        }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 32px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            color: var(--paper);
            opacity: 0.6;
        }

        .footer-copy {
            font-size: 0.8rem;
            color: var(--mist);
            letter-spacing: 0.05em;
        }

        @media (max-width: 640px) {
            nav { padding: 20px 24px; }
            .features { padding: 80px 24px; }
            .cta-banner { margin: 0 24px 60px; padding: 60px 28px; }
            footer { padding: 28px 24px; flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Ambient Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- ── NAVBAR ── -->
    <nav>
        <a href="/" class="nav-logo">Task<span>·</span>Manager</a>
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
            @endauth
        </div>
    </nav>

    <!-- ── HERO ── -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">
                <span class="eyebrow-line"></span>
                Your productivity, elevated
                <span class="eyebrow-line"></span>
            </div>
            <h1 class="hero-title">
                Organize.<br>
                Focus.<br>
                <em>Achieve.</em>
            </h1>
            <p class="hero-subtitle">
                A refined workspace for managing your daily tasks — built for those who take their time seriously.
            </p>

            @guest
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-primary">Begin for free</a>
                    <a href="{{ route('login') }}" class="btn-secondary">Sign in</a>
                </div>
            @endguest
        </div>

        <div class="scroll-hint">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- ── DIVIDER ── -->
    <div class="divider">
        <div class="divider-line"></div>
        <div class="divider-icon">◆</div>
        <div class="divider-line"></div>
    </div>

    <!-- ── FEATURES ── -->
    <section class="features">
        <div class="features-header">
            <span class="section-label">What you get</span>
            <h2 class="section-title">Everything you need.<br>Nothing you don't.</h2>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-glyph">📋</div>
                <h3 class="feature-title">Manage Tasks</h3>
                <p class="feature-desc">Create, update and organize your tasks with an intuitive interface designed to keep you moving forward.</p>
            </div>
            <div class="feature-card">
                <div class="feature-glyph">⚡</div>
                <h3 class="feature-title">Track Progress</h3>
                <p class="feature-desc">Monitor task status at a glance. Stay on schedule and see exactly how much you've accomplished.</p>
            </div>
            <div class="feature-card">
                <div class="feature-glyph">🔒</div>
                <h3 class="feature-title">Secure Access</h3>
                <p class="feature-desc">Your tasks are yours alone. Robust authentication ensures your workspace stays private and protected.</p>
            </div>
        </div>
    </section>

    <!-- ── CTA BANNER ── -->
    @guest
        <div class="cta-banner">
            <h2 class="cta-title">Ready to take control<br>of your day?</h2>
            <p class="cta-subtitle">Join thousands already working smarter.</p>
            <a href="{{ route('register') }}" class="btn-primary">Create your free account</a>
        </div>
    @endguest

    <!-- ── FOOTER ── -->
    <footer>
        <div class="footer-logo">Task·Manager</div>
        <p class="footer-copy">© {{ date('Y') }} Task Manager. All rights reserved.</p>
    </footer>

</body>
</html>