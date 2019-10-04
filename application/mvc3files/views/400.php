<!doctype html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8"/>
<title>Story Carry - 400 Page not found</title>
<style>
	body{
		font-family: Arial, Helvetica, sans-serif;
		background-color: rgb(238, 238, 238);
	}
	a{
	    text-decoration:none;
	}
	.svg{
		width: 100%;
		height: 50%;
		text-align: center;
	}
	svg{
		max-width:100%;
	}
	.backto {
		border-radius: 5px;
		background: linear-gradient(-60deg, RoyalBlue,brown);
		color: white;
		width: auto;
		border: none;
		cursor: pointer;
		outline: none;
		padding: 15px 10px 15px 10px;
		margin-bottom: 10px;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
		font-size: 16px;
		text-decoration:none;
	}
	</style>
</head>
<body>
<div class ='svg'>
<svg width="400px" height="400px" viewBox="-200 -100 400 400" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
	<defs>
		<rect id="animatedRect" x="-400" y="-100" width="400" height="400">
			<animateTransform attributeName="transform" type="rotate"
				from="45,0,-150" to="0,0,-150"
				begin="0s" dur="3s"
				repeatCount="indefinite"
				calcMode="spline" keyTimes="0;1" keySplines="0.42 0.0 0.58 1.0"
			/>
		</rect>
		<clipPath id="clip">
			<use xlink:href="#animatedRect"/>
		</clipPath>
		<mask id="mask" maskUnits="userSpaceOnUse" x="-200" y="-100" width="400" height="400">
			<rect x="-150" y="0" width="150" height="200" fill="hsla(255,255%,255%,1)" clip-path="url(#clip)"/>
        </mask>
		<g id="page" font-size="22">
			<rect x="-150" y="0" width="150" height="200" fill="hsla(52, 95%, 95%, 1)"/>
			<text x="-136" y="113">400 ERROR</text>
		</g>
		<linearGradient id="centerGrad" x1="1" x2="0">
			<stop offset="0" stop-color="hsla(0,0%,0%,1)" stop-opacity="0.3"/>
			<stop offset="0.02" stop-color="hsla(0,0%,0%,1)" stop-opacity="0"/>
		</linearGradient>
		<filter id="shadow">
			<feOffset in="SourceAlpha">
				<animate attributeName="dx"
					begin="0s" dur="3s"
					repeatCount="indefinite"
					calcMode="linear" keyTimes="0;0.5;1" values="0;-1;0"
				/>
				<animate attributeName="dy"
					begin="0s" dur="3s"
					repeatCount="indefinite"
					calcMode="linear" keyTimes="0;0.5;1" values="0;1;0"
				/>
			</feOffset>
			<feGaussianBlur>
				<animate attributeName="stdDeviation"
					begin="0s" dur="3s"
					repeatCount="indefinite"
					calcMode="linear" keyTimes="0;0.5;1" values="0;3;0"
				/>
			</feGaussianBlur>
			<feMerge>
				<feMergeNode/>
				<feMergeNode in="SourceGraphic"/>
			</feMerge>
		</filter>
	</defs>

	<rect x="-161" y="2" width="322" height="208" fill="hsla(52, 5%, 55%, 1)" rx="2" ry="2"/>
	<rect x="-160" y="1" width="320" height="208" fill="hsla(1, 95%, 15%, 1)" rx="2" ry="2"/>
	<path d="M-150,0 L-155,5 V205 L-5,205 L0,200" fill="hsla(52, 5%, 85%, 1)"/>
	<path d="M150,0 L155,5 V205 L5,205 L0,200" fill="hsla(52, 5%, 85%, 1)"/>
	
	<rect x="0" width="150" height="200" fill="hsla(52, 95%, 95%, 1)"/>
	<g font-size="14">
		<text x="15" y="85">The page you are </text>
		<text x="15" y="110">looking for is not</text>
		<text x="15" y="135">found in our Book.</text>
	</g>
	<use xlink:href="#page"/>
	<rect  x="-400" y="0" width="400" height="200" fill="url(#centerGrad)"/>
    <g filter="url(#shadow)">
        <g>
            <g mask="url(#mask)">
                <use xlink:href="#page"/>
                <use xlink:href="#animatedRect" fill="url(#centerGrad)"/>
            </g>
            <animateTransform attributeName="transform" type="rotate"
                from="-90,0,-150" to="0,0,-150"
                begin="0s" dur="3s"
                repeatCount="indefinite"
                calcMode="spline" keyTimes="0;1" keySplines="0.42 0.0 0.58 1.0"/>
        </g>
    </g>
</svg>
</div>
<div style="text-align:center">
<a href="<?php echo base_url();?>" class="backto">GET BACK TO HOME PAGE</a>
</div>
</body>
</html>
