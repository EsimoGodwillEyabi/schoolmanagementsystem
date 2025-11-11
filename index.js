// Toggle the #university-dropdown open state on scroll and click
(() => {
	const dropdown = document.getElementById('university-dropdown');
	const toggle = dropdown ? dropdown.querySelector('.drop-toggle') : null;

	function setOpen(open) {
		if (!dropdown) return;
		dropdown.classList.toggle('open', open);
	}

	// Debounce helper
	function debounce(fn, wait) {
		let t;
		return (...args) => {
			clearTimeout(t);
			t = setTimeout(() => fn.apply(this, args), wait);
		};
	}

	// Open dropdown when scrolled past 100px
	function onScroll() {
		const scrollY = window.scrollY || window.pageYOffset;
		setOpen(scrollY > 100);
	}

	window.addEventListener('scroll', debounce(onScroll, 50));

	// Also allow click to toggle
	if (toggle) {
		toggle.addEventListener('click', (e) => {
			e.preventDefault();
			const isOpen = dropdown.classList.contains('open');
			setOpen(!isOpen);
		});
	}
})();

// Testimonial slider
(function() {
	const slider = document.getElementById('testimonial-slider');
	if (!slider) return;

	const slidesWrap = slider.querySelector('.slides');
	const slides = Array.from(slidesWrap.children);
	const prevBtn = slider.querySelector('.prev');
	const nextBtn = slider.querySelector('.next');
	const dotsWrap = slider.querySelector('.dots');

	let current = 0;
	let autoplayInterval = 4000;
	let timer = 500;

	function goTo(index) {
		current = (index + slides.length) % slides.length;
		slidesWrap.style.transform = `translateX(-${current * 100}%)`;
		updateDots();
	}

	function next() { goTo(current + 1); }
	function prev() { goTo(current - 1); }

	function startAutoplay() { stopAutoplay(); timer = setInterval(next, autoplayInterval); }
	function stopAutoplay() { if (timer) { clearInterval(timer); timer = null; } }

	function updateDots() {
		dotsWrap.querySelectorAll('.dot').forEach((d, i) => d.classList.toggle('active', i === current));
	}

	// Create dots
	slides.forEach((s, i) => {
		const dot = document.createElement('button');
		dot.className = 'dot';
		dot.setAttribute('aria-label', `Show testimonial ${i+1}`);
		dot.addEventListener('click', () => { goTo(i); });
		dotsWrap.appendChild(dot);
	});

	prevBtn.addEventListener('click', prev);
	nextBtn.addEventListener('click', next);

	// Pause on hover
	slider.addEventListener('mouseenter', stopAutoplay);
	slider.addEventListener('mouseleave', startAutoplay);

	// keyboard navigation
	slider.addEventListener('keydown', (e) => {
		if (e.key === 'ArrowLeft') prev();
		if (e.key === 'ArrowRight') next();
	});

	// Init
	goTo(0);
	startAutoplay();
})();

