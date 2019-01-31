<style type="text/css" media="screen">
	.flex-container {
	  	/*height: 100%;
	 	padding: 0;
	  	margin: 0;*/
	  	display: flex;
	    background-color: #441151;
	  	align-items: center;
	  	justify-content: center;
	}
	h1.loader_below {
	  position: absolute;
	  font-family: 'Open Sans';
	  font-weight: 600;
	  font-size: 12px;
	  text-transform: uppercase;
	  left: 50%;
	  top: 58%;
	  color:#ffffff;
	  margin-left: -120px;
	}

	h1.loader_above {
	  position: absolute;
	  font-family: 'Open Sans';
	  font-weight: 600;
	  font-size: 12px;
	  text-transform: uppercase;
	  left: 50%;
	  top: 40%;
	  color:#ffffff;
	  margin-left: -120px;
	}

	.body {
	  position: absolute;
	  top: 10%;
	  margin-left: -200px;
	  align-content: center;
	  left: 50%;
	  animation: speeder .4s linear infinite;
	}
	.body > span {
	  height: 5px;
	  width: 35px;
	  background: #ffffff;
	  position: absolute;
	  top: -19px;
	  left: 60px;
	  border-radius: 2px 10px 1px 0;
	}

	.base span {
	  position: absolute;
	  width: 0;
	  height: 0;
	  border-top: 6px solid transparent;
	  border-right: 100px solid #ffffff;
	  border-bottom: 6px solid transparent;
	}
	.base span:before {
	  content: "";
	  height: 22px;
	  width: 22px;
	  border-radius: 50%;
	  background: #ffffff;
	  position: absolute;
	  right: -110px;
	  top: -16px;
	}
	.base span:after {
	  content: "";
	  position: absolute;
	  width: 0;
	  height: 0;
	  border-top: 0 solid transparent;
	  border-right: 55px solid #ffffff;
	  border-bottom: 16px solid transparent;
	  top: -16px;
	  right: -98px;
	}

	.face {
	  position: absolute;
	  height: 12px;
	  width: 20px;
	  background: #ffffff;
	  border-radius: 20px 20px 0 0;
	  transform: rotate(-40deg);
	  right: -125px;
	  top: -15px;
	}
	.face:after {
	  content: "";
	  height: 12px;
	  width: 12px;
	  background: #ffffff;
	  right: 4px;
	  top: 7px;
	  position: absolute;
	  transform: rotate(40deg);
	  transform-origin: 50% 50%;
	  border-radius: 0 0 0 2px;
	}

	.body > span > span:nth-child(1),
	.body > span > span:nth-child(2),
	.body > span > span:nth-child(3),
	.body > span > span:nth-child(4) {
	  width: 30px;
	  height: 1px;
	  background: #ffffff;
	  position: absolute;
	  animation: fazer1 .2s linear infinite;
	}

	.body > span > span:nth-child(2) {
	  top: 3px;
	  animation: fazer2 .4s linear infinite;
	}

	.body > span > span:nth-child(3) {
	  top: 1px;
	  animation: fazer3 .4s linear infinite;
	  animation-delay: -1s;
	}

	.body > span > span:nth-child(4) {
	  top: 4px;
	  animation: fazer4 1s linear infinite;
	  animation-delay: -1s;
	}

	@keyframes fazer1 {
	  0% {
	    left: 0;
	  }
	  100% {
	    left: -80px;
	    opacity: 0;
	  }
	}
	@keyframes fazer2 {
	  0% {
	    left: 0;
	  }
	  100% {
	    left: -100px;
	    opacity: 0;
	  }
	}
	@keyframes fazer3 {
	  0% {
	    left: 0;
	  }
	  100% {
	    left: -50px;
	    opacity: 0;
	  }
	}
	@keyframes fazer4 {
	  0% {
	    left: 0;
	  }
	  100% {
	    left: -150px;
	    opacity: 0;
	  }
	}
	@keyframes speeder {
	  0% {
	    transform: translate(2px, 1px) rotate(0deg);
	  }
	  10% {
	    transform: translate(-1px, -3px) rotate(-1deg);
	  }
	  20% {
	    transform: translate(-2px, 0px) rotate(1deg);
	  }
	  30% {
	    transform: translate(1px, 2px) rotate(0deg);
	  }
	  40% {
	    transform: translate(1px, -1px) rotate(1deg);
	  }
	  50% {
	    transform: translate(-1px, 3px) rotate(-1deg);
	  }
	  60% {
	    transform: translate(-1px, 1px) rotate(0deg);
	  }
	  70% {
	    transform: translate(3px, 1px) rotate(-1deg);
	  }
	  80% {
	    transform: translate(-2px, -1px) rotate(1deg);
	  }
	  90% {
	    transform: translate(2px, 1px) rotate(0deg);
	  }
	  100% {
	    transform: translate(1px, -2px) rotate(-1deg);
	  }
	}
	.longfazers {
	  position: absolute;
	  width: 100%;
	  height: 100%;
	}
	.longfazers span {
	  position: absolute;
	  height: 2px;
	  width: 20%;
	  background: #ffffff;
	}
	.longfazers span:nth-child(1) {
	  top: 20%;
	  animation: lf .6s linear infinite;
	  animation-delay: -5s;
	}
	.longfazers span:nth-child(2) {
	  top: 40%;
	  animation: lf2 .8s linear infinite;
	  animation-delay: -1s;
	}
	.longfazers span:nth-child(3) {
	  top: 60%;
	  animation: lf3 .6s linear infinite;
	}
	.longfazers span:nth-child(4) {
	  top: 80%;
	  animation: lf4 .5s linear infinite;
	  animation-delay: -3s;
	}

	@keyframes lf {
	  0% {
	    left: 200%;
	  }
	  100% {
	    left: -200%;
	    opacity: 0;
	  }
	}
	@keyframes lf2 {
	  0% {
	    left: 200%;
	  }
	  100% {
	    left: -200%;
	    opacity: 0;
	  }
	}
	@keyframes lf3 {
	  0% {
	    left: 200%;
	  }
	  100% {
	    left: -100%;
	    opacity: 0;
	  }
	}
	@keyframes lf4 {
	  0% {
	    left: 200%;
	  }
	  100% {
	    left: -100%;
	    opacity: 0;
	  }
	}
	.wrapper {
	  perspective: 0px;
	  background-image: url('http://svgur.com/i/6f.svg');
	  height: 650px;
	  align-items: center;
	  justify-content: center;
	}

	#lights {
	  position: absolute;
	  width: 850px;
	  height: 650px
	}

	#stars {
	  position: absolute;
	  width: 850px;
	  height: 650px;
	}

	.star-bg {
	  animation: stars-animation 3s linear infinite;
	}

	.star-bg.big {
	  animation-delay: 1.5s;
	}

	@keyframes stars-animation {
	  0% {
	    opacity: .5;
	  }
	  50% {
	    opacity: 1;
	  }
	  100% {
	    opacity: .5
	  }
	}

	.light-bulb {
	  animation: light-animation 3s linear infinite;
	}

	@keyframes light-animation {
	  0% {
	    r: 30;
	  }
	  50% {
	    r: 40;
	  }
	  100% {
	    r: 30;
	  }
	}

	#carousel {
	  width: 850px;
	  height: 650px;
	  text-align: center;
	  position: relative;
	  transform-style: preserve-3d;
	}

	#horse-ride img {
	  max-width: 550px;
	  display: inline-block;
	}

	#horse-ride {
	  transform-style: preserve-3d;
	  transform: translate3d(0, 0, 100px);
	}

	#pole {
	  width: 25px;
	  height: 195px;
	  background-image: url('http://svgur.com/i/4k.svg');
	  position: absolute;
	  left: 0;
	  background-size: cover;
	  right: 0;
	  margin-left: auto;
	  margin-right: auto;
	  top: 285px;
	  animation: pole-animation 3s linear infinite;
	  transform: translate3d(0, 0, -50px);
	}

	@keyframes pole-animation {
	  0% {
	    background-position: bottom;
	  }
	  100% {
	    background-position: top;
	  }
	}

	#cylinder {
	  width: 100px;
	  transform-style: preserve-3d;
	  position: absolute;
	  top: 290px;
	  left: 0;
	  right: 0;
	  margin-left: auto;
	  margin-right: auto;
	  transform: translate3d(0, 0, -100px);
	}

	#fade-black {
	  width: 190px;
	  height: 164px;
	  position: absolute;
	  background: rgba(0, 0, 0, 0.4);
	  top: 286px;
	  left: 330px;
	  transform: translate3d(0, 0, -120px);
	}

	#horses {
	  transform-style: preserve-3d;
	  animation: spin 15s infinite linear;
	  transform-origin: center;
	  transform-box: fill-box;
	}

	@keyframes spin {
	  0% {
	    transform: rotateY(-360deg);
	  }
	}

	#horses div {
	  background-size: cover;
	  position: absolute;
	  height: 155px;
	  width: 95px;
	  transform-origin: center;
	  background-image: url('http://svgur.com/i/6e.svg');
	}

	.hors {
	  animation: horses-animation 3s linear infinite;
	}

	.hors.down {
	  animation-delay: 1.5s
	}

	@keyframes horses-animation {
	  50% {
	    margin-top: -30px;
	  }
	}

	#horses .a {
	  transform: rotateY(0deg) translateZ(100px);
	  animation-delay: .2s;
	}

	#horses .b {
	  transform: rotateY(60deg) translateZ(100px);
	}

	#horses .c {
	  transform: rotateY(120deg) translateZ(100px);
	}

	#horses .d {
	  transform: rotateY(180deg) translateZ(100px);
	}

	#horses .e {
	  transform: rotateY(240deg) translateZ(100px);
	}

	#horses .f {
	  transform: rotateY(300deg) translateZ(100px);
	}
</style>
<div class="flex-container">
	<div class="wrapper">
		<div id="stars">
			<div class='body'>
			    <span>
			        <span></span>
			        <span></span>
			        <span></span>
			        <span></span>
			    </span>
			    <div class='base'>
			        <span></span>
			        <div class='face'></div>
			    </div>
			</div>
			<svg id="stars" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
				<g id="stars-2" data-name="stars">
					<g id="rect">
						<g id="star" class="star-bg big">
							<path d="M208.68,108.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M204.7,101.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V101.87Z" fill="#ee85b5"/>
						</g>
						<g id="star-2" class="star-bg big" data-name="star">
							<path d="M95.68,194.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M91.7,187.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V187.87Z" fill="#ee85b5"/>
						</g>
						<g id="star-3" class="star-bg big" data-name="star">
							<path d="M295.68,64.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M291.7,57.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V57.87Z" fill="#ee85b5"/>
						</g>
						<g id="star-4" class="star-bg big" data-name="star">
							<path d="M379.68,160.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M375.7,153.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V153.87Z" fill="#ee85b5"/>
						</g>
						<g id="star-5" class="star-bg big" data-name="star">
							<path d="M498.68,128.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M494.7,121.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V121.87Z" fill="#ee85b5"/>
						</g>
						<g id="star-6" class="star-bg big" data-name="star">
							<path d="M653.68,139.13a4.5,4.5,0,0,1-2.87-2.87l-1.12-3.4-1.12,3.4a4.5,4.5,0,0,1-2.87,2.87l-3.4,1.12,3.4,1.12a4.5,4.5,0,0,1,2.87,2.87l1.12,3.4,1.12-3.4a4.5,4.5,0,0,1,2.87-2.87l3.4-1.12Z" fill="#ffaaa3"/>
							<path d="M649.7,132.87l1.12,3.4a4.5,4.5,0,0,0,2.87,2.87l3.4,1.12-3.4,1.12a4.5,4.5,0,0,0-2.87,2.87l-1.12,3.4V132.87Z" fill="#ee85b5"/>
						</g>
					</g>
					<g id="dots">
						<circle class="star-bg small" cx="419.81" cy="84.29" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="478.81" cy="203.29" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="309.28" cy="147.62" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="85.55" cy="65.24" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="717.52" cy="175.5" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="582.87" cy="66.63" r="2.62" fill="#ff958c"/>
						<circle class="star-bg small" cx="702.57" cy="98.13" r="2.62" fill="#ff958c"/>
					</g>
				</g>
			</svg>
		</div>
		<div id="lights">
			<svg id="lights" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 800 600">
				<defs>
					<radialGradient id="radial-gradient" cx="205.17" cy="270.39" r="41.14" gradientUnits="userSpaceOnUse">
						<stop offset="0.01" stop-color="#ff958c"/>
						<stop offset="0.18" stop-color="#ff958c" stop-opacity="0.77"/>
						<stop offset="0.41" stop-color="#ff958c" stop-opacity="0.5"/>
						<stop offset="0.61" stop-color="#ff958c" stop-opacity="0.28"/>
						<stop offset="0.78" stop-color="#ff958c" stop-opacity="0.13"/>
						<stop offset="0.92" stop-color="#ff958c" stop-opacity="0.03"/>
						<stop offset="1" stop-color="#ff958c" stop-opacity="0"/>
					</radialGradient>
					<radialGradient id="radial-gradient-2" cx="628.17" cy="270.39" r="41.14" xlink:href="#radial-gradient"/>
				</defs>
				<g id="light1">
					<g>
						<path d="M202.39,400l0.12,0h2.66V293.53h-2.78V400Z" fill="#bf7069"/>
						<path d="M202.39,400a2.77,2.77,0,0,0-2.66,2.76v12.84a2.88,2.88,0,0,1,.53-0.11h4.91V400h-2.66Z" fill="#b36488"/>
						<path d="M200.26,415.48a2.88,2.88,0,0,0-.53.11,3,3,0,0,0-2.52,2.94v33h8v-36h-4.91Z" fill="#653162"/>
						<path d="M200.44,286.88H198a2.5,2.5,0,0,0-2.38,2.6v1.44a2.5,2.5,0,0,0,2.38,2.6h7.14v-6.64h-4.73Z" fill="#441b3c"/>
					</g>
					<g>
						<path d="M207.21,400l-0.12,0h-2.66V293.53h2.78V400Z" fill="#bf7069"/>
						<path d="M207.21,400a2.77,2.77,0,0,1,2.66,2.76v12.84a2.88,2.88,0,0,0-.53-0.11h-4.91V400h2.66Z" fill="#b36488"/>
						<path d="M209.34,415.48a2.88,2.88,0,0,1,.53.11,3,3,0,0,1,2.52,2.94v33h-8v-36h4.91Z" fill="#653162"/>
						<path d="M209.16,286.88h2.41a2.5,2.5,0,0,1,2.38,2.6v1.44a2.5,2.5,0,0,1-2.38,2.6h-7.14v-6.64h4.73Z" fill="#441b3c"/>
					</g>
					<circle class="light-bulb" cx="205.17" cy="270.39" r="41.14" fill="url(#radial-gradient)"/>
					<circle cx="205.17" cy="270.39" r="17.93" fill="#ffaaa3" opacity="0.8"/>
					<path d="M196.69,260c-0.6-.79-3.16-0.05-3.93.58s-2.57,3.9-1.53,4.42,2.93-.52,3.94-0.62C196.44,264.29,197.46,261.05,196.69,260Z" fill="#ffaaa3"/>
				</g>
				<g id="light2">
					<g>
						<path d="M625.39,400l0.12,0h2.66V293.53h-2.78V400Z" fill="#bf7069"/>
						<path d="M625.39,400a2.77,2.77,0,0,0-2.66,2.76v12.84a2.88,2.88,0,0,1,.53-0.11h4.91V400h-2.66Z" fill="#b36488"/>
						<path d="M623.26,415.48a2.88,2.88,0,0,0-.53.11,3,3,0,0,0-2.52,2.94v33h8v-36h-4.91Z" fill="#653162"/>
						<path d="M623.44,286.88H621a2.5,2.5,0,0,0-2.38,2.6v1.44a2.5,2.5,0,0,0,2.38,2.6h7.14v-6.64h-4.73Z" fill="#441b3c"/>
					</g>
					<g>
						<path d="M630.21,400l-0.12,0h-2.66V293.53h2.78V400Z" fill="#bf7069"/>
						<path d="M630.21,400a2.77,2.77,0,0,1,2.66,2.76v12.84a2.88,2.88,0,0,0-.53-0.11h-4.91V400h2.66Z" fill="#b36488"/>
						<path d="M632.34,415.48a2.88,2.88,0,0,1,.53.11,3,3,0,0,1,2.52,2.94v33h-8v-36h4.91Z" fill="#653162"/>
						<path d="M632.16,286.88h2.41a2.5,2.5,0,0,1,2.38,2.6v1.44a2.5,2.5,0,0,1-2.38,2.6h-7.14v-6.64h4.73Z" fill="#441b3c"/>
					</g>
					<circle class="light-bulb" cx="628.17" cy="270.39" r="41.14" fill="url(#radial-gradient-2)"/>
					<circle cx="628.17" cy="270.39" r="17.93" fill="#ffaaa3" opacity="0.8"/>
					<path d="M619.69,260c-0.6-.79-3.16-0.05-3.93.58s-2.57,3.9-1.53,4.42,2.93-.52,3.94-0.62C619.44,264.29,620.46,261.05,619.69,260Z" fill="#ffaaa3"/>
				</g>
			</svg>
		</div>
		<div id="carousel">
			<div id="horse-ride">
				<svg id="ground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
					<g>
						<path d="M183.77,523a16.5,16.5,0,0,1,0-33H616.23a16.5,16.5,0,0,1,0,33H183.77Z" fill="#773069"/>
						<rect x="151" y="451" width="499" height="40" rx="16.26" ry="16.26" transform="translate(801 942) rotate(180)" fill="#883677"/>
					</g>
					<g id="carousel-2" data-name="carousel">
						<path d="M401,191.7s0-4.82,0-14.45c2.59,0.89,6.22,2.65,8.89,2.65,3.26,0,7.15-1.83,10.34-2.65l-4.78,5.26,6,2.15c-5.38,4.92-13.47,1.32-20.23.51l0.05,6.53H401Z" fill="#b257b0"/>
						<polygon points="401.13 187 288.44 269 325.69 269 325.85 269 363.23 269 363.39 269 400.77 269 400.92 269 401.13 269 438.79 269 438.94 269 476.32 269 476.48 269 513.73 269 401.13 187" fill="#ee85b5"/>
						<polygon points="438.79 269.05 438.94 269.05 476.32 269.05 476.48 269.05 513.73 269.05 401.13 187.06 401.13 269.05 438.79 269.05" fill="#ca61c3"/>
						<path d="M274.71,443l9.68-13.91H402.13v22.19H279.85C275.15,451.27,272.26,446.62,274.71,443Z" fill="#ee85b5"/>
						<path d="M525.31,443l-9-13.91H401v22.19H520.26C524.88,451.27,527.72,446.62,525.31,443Z" fill="#ca61c3"/>
						<polygon points="516.31 428.45 516.31 417.92 400.05 417.92 400.05 429.08 516.31 429.08 516.31 428.45" fill="#883677"/>
						<polygon points="284.39 428.45 284.39 417.92 401.13 417.92 401.13 429.08 284.39 429.08 284.39 428.45" fill="#883677"/>
						<path d="M476.16,269H288.44c0,10,8.41,19,18.78,19A18.9,18.9,0,0,0,326,269a18.76,18.76,0,0,0,37.52.61A18.9,18.9,0,0,0,382.25,288h0.1a18.9,18.9,0,0,0,18.77-19c0,9,6.8,19,18.79,19a18.88,18.88,0,0,0,18.73-18.21A18.89,18.89,0,0,0,457.39,288c9.61,0,18.5-9.36,18.82-18.34A18.9,18.9,0,0,0,495,288c10.37,0,18.78-9,18.78-19H476.16Z" fill="#883677"/>
					</g>
				</svg>
			</div>
			<div id="fade-black"></div>
			<div id="pole">

			</div>
			<div id="cylinder">
				<div id="horses">
					<div class="a"><img class="hors up" src="http://svgur.com/i/5o.svg" /></div>
					<div class="b"><img class="hors down" src="http://svgur.com/i/5o.svg" /></div>
					<div class="c"><img class="hors up" src="http://svgur.com/i/5o.svg" /></div>
					<div class="d"><img class="hors down" src="http://svgur.com/i/5o.svg" /></div>
					<div class="e"><img class="hors up" src="http://svgur.com/i/5o.svg" /></div>
					<div class="f"><img class="hors down" src="http://svgur.com/i/5o.svg" /></div>

				</div>
			</div>
		</div>
	</div>
</div>