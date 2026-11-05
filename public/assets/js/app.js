/* ============================================
   secad.ir - اسکریپت‌های اصلی
   ============================================ */
document.addEventListener('DOMContentLoaded', () => {

    /* ---------- ۱. تغییر تم تاریک/روشن ---------- */
    const themeToggle = document.getElementById('themeToggle');
    const htmlEl = document.documentElement;

    function updateThemeIcon() {
        if (!themeToggle) return;
        themeToggle.textContent = htmlEl.getAttribute('data-theme') === 'dark' ? '☀️' : '🌙';
    }

    // تنظیم آیکون اولیه بر اساس چیزی که در <head> تعیین شده
    updateThemeIcon();

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            if (htmlEl.getAttribute('data-theme') === 'dark') {
                htmlEl.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                htmlEl.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
            updateThemeIcon();
        });
    }

    /* ---------- ۲. منوی موبایل ---------- */
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navLinks.classList.toggle('active');
        });

        // بستن منو با کلیک روی هر لینک
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });

        // بستن منو با کلیک بیرون از آن
        document.addEventListener('click', (e) => {
            if (!navLinks.contains(e.target) && e.target !== menuToggle) {
                navLinks.classList.remove('active');
            }
        });
    }

    /* ---------- ۳. دکمه کپی در بلوک‌های کد ---------- */
    const preBlocks = document.querySelectorAll('.content-area pre');

    preBlocks.forEach((pre) => {
        const btn = document.createElement('button');
        btn.className = 'copy-code-btn';
        btn.type = 'button';
        btn.innerText = 'کپی';

        btn.addEventListener('click', () => {
            const codeElement = pre.querySelector('code');
            if (!codeElement) return;

            const codeText = codeElement.innerText;

            navigator.clipboard.writeText(codeText).then(() => {
                btn.innerText = 'کپی شد!';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.innerText = 'کپی';
                    btn.classList.remove('copied');
                }, 2000);
            }).catch((err) => {
                console.error('خطا در کپی:', err);
                btn.innerText = 'خطا';
                setTimeout(() => { btn.innerText = 'کپی'; }, 2000);
            });
        });

        pre.appendChild(btn);
    });

    /* ---------- ۴. انیمیشن پس‌زمینه کد ---------- */
    const bgContainer = document.getElementById('code-background');
    if (bgContainer) {
        const symbols = ['php?>', '</>', 'echo', 'while', 'if', 'array', 'and', '$', '++', 'or', 'function', '=>', '{ }'];
        const numSymbols = 12;

        for (let i = 0; i < numSymbols; i++) {
            const span = document.createElement('span');
            span.className = 'code-symbol';
            span.innerText = symbols[Math.floor(Math.random() * symbols.length)];
            span.style.left = Math.random() * 100 + '%';
            span.style.fontSize = (Math.random() * 30 + 20) + 'px';
            span.style.animationDuration = (Math.random() * 25 + 15) + 's';
            span.style.animationDelay = '-' + (Math.random() * 20) + 's';
            bgContainer.appendChild(span);
        }
    }
});