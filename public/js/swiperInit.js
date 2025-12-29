var swiper = new Swiper(".desktopSixSlider", {
	autoplay: {
		delay: 3000,
	},
	speed: 1000,
	loop: true,
	navigation: {
		nextEl: ".button-next",
		prevEl: ".button-prev",
	},
});

var swiper = new Swiper(".firstSlider", {
	autoplay: {
		delay: 3000,
	},
	speed: 1000,
	loop: true,
	breakpoints: {
		// when window width is >= 768px
		768: {
			slidesPerView: 2.75,
			spaceBetween: 0,
		},
		// when window width is >= 1024px
		1024: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		// when window width is >= 1280px
		1280: {
			slidesPerView: 3.75,
			spaceBetween: 42,
		},
	},
});

var swiper = new Swiper(".imageSlider", {
	autoplay: {
		delay: 3000,
	},
	speed: 1000,
	loop: true,
	slidesPerView: 1.5,
	spaceBetween: 22,
	slidesOffsetBefore: -130,
	slidesOffsetAfter: 0,

	breakpoints: {
		// when window width is >= 768px
		768: {
			slidesPerView: 2.5,
			slidesOffsetBefore: -160,
			slidesOffsetAfter: 0,
		},
		// when window width is >= 1024px
		1024: {
			slidesPerView: 3.55,
		},
		// when window width is >= 1280px
		1280: {
			slidesPerView: 3.63,
			slidesOffsetBefore: -130,
			slidesOffsetAfter: 0,
		},
		// when window width is >= 1440px
		1440: {
			slidesPerView: 3.6,
			slidesOffsetBefore: -165,
			slidesOffsetAfter: 0,
		},
		// when window width is >= 1600px
		1600: {
			slidesPerView: 3.65,
			slidesOffsetBefore: -170,
			slidesOffsetAfter: 0,
		},
	},
});
