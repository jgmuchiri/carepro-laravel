<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>{{\Config::get('app.name')}}</title>
	<style>
		/* -------------------------------------
			GLOBAL RESETS
		------------------------------------- */
		img {
			border: none;
			-ms-interpolation-mode: bicubic;
			max-width: 100%;
		}

		body {
			background-color: #f6f6f6;
			font-family: sans-serif;
			-webkit-font-smoothing: antialiased;
			font-size: 14px;
			line-height: 1.4;
			margin: 0;
			padding: 0;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		table {
			border-collapse: separate;
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
			width: 100%;
		}

		table td {
			font-family: sans-serif;
			font-size: 14px;
			vertical-align: top;
		}

		/* -------------------------------------
			BODY & CONTAINER
		------------------------------------- */

		.body {
			background-color: #f6f6f6;
			width: 100%;
		}

		.container {
			display: block;
			Margin: 0 auto !important;
			/* makes it centered */
			max-width: 580px;
			padding: 10px;
			width: 580px;
		}

		.content {
			box-sizing: border-box;
			display: block;
			Margin: 0 auto;
			max-width: 580px;
			padding: 10px;
		}

		/* -------------------------------------
			HEADER, FOOTER, MAIN
		------------------------------------- */
		.main {
			background: #ffffff;
			border-radius: 3px;
			width: 100%;
		}

		.wrapper {
			box-sizing: border-box;
			padding: 20px;
		}

		.content-block {
			padding-bottom: 10px;
			padding-top: 10px;
		}

		.footer {
			clear: both;
			Margin-top: 10px;
			text-align: center;
			width: 100%;
		}

		.footer td,
		.footer p,
		.footer span,
		.footer a {
			color: #999999;
			font-size: 12px;
			text-align: center;
		}

		/* -------------------------------------
			TYPOGRAPHY
		------------------------------------- */
		h1,
		h2,
		h3,
		h4 {
			color: #000000;
			font-family: sans-serif;
			font-weight: 400;
			line-height: 1.4;
			margin: 0;
			Margin-bottom: 30px;
		}

		h1 {
			font-size: 35px;
			font-weight: 300;
			text-align: center;
			text-transform: capitalize;
		}

		p,
		ul,
		ol {
			font-family: sans-serif;
			font-size: 14px;
			font-weight: normal;
			margin: 0;
			Margin-bottom: 15px;
		}

		p li,
		ul li,
		ol li {
			list-style-position: inside;
			margin-left: 5px;
		}

		a {
			color: #3498db;
			text-decoration: underline;
		}

		/* -------------------------------------
			BUTTONS
		------------------------------------- */
		.btn {
			box-sizing: border-box;
			width: 100%;
		}

		.btn > tbody > tr > td {
			padding-bottom: 15px;
		}

		.btn table {
			width: auto;
		}

		.btn table td {
			background-color: #ffffff;
			border-radius: 5px;
			text-align: center;
		}

		.btn a {
			background-color: #ffffff;
			border: solid 1px #3498db;
			border-radius: 5px;
			box-sizing: border-box;
			color: #3498db;
			cursor: pointer;
			display: inline-block;
			font-size: 14px;
			font-weight: bold;
			margin: 0;
			padding: 12px 25px;
			text-decoration: none;
			text-transform: capitalize;
		}

		.btn-primary table td {
			background-color: #3498db;
		}

		.btn-primary a {
			background-color: #3498db;
			border-color: #3498db;
			color: #ffffff;
		}

		/* -------------------------------------
			OTHER STYLES THAT MIGHT BE USEFUL
		------------------------------------- */
		.last {
			margin-bottom: 0;
		}

		.first {
			margin-top: 0;
		}

		.align-center {
			text-align: center;
		}

		.align-right {
			text-align: right;
		}

		.align-left {
			text-align: left;
		}

		.clear {
			clear: both;
		}

		.mt0 {
			margin-top: 0;
		}

		.mb0 {
			margin-bottom: 0;
		}

		.preheader {
			color: transparent;
			display: none;
			height: 0;
			max-height: 0;
			max-width: 0;
			opacity: 0;
			overflow: hidden;
			mso-hide: all;
			visibility: hidden;
			width: 0;
		}

		.powered-by a {
			text-decoration: none;
		}

		hr {
			border: 0;
			border-bottom: 1px solid #f6f6f6;
			Margin: 20px 0;
		}

		/* -------------------------------------
			RESPONSIVE AND MOBILE FRIENDLY STYLES
		------------------------------------- */
		@media only screen and (max-width: 620px) {
			table[class=body] h1 {
				font-size: 28px !important;
				margin-bottom: 10px !important;
			}

			table[class=body] p,
			table[class=body] ul,
			table[class=body] ol,
			table[class=body] td,
			table[class=body] span,
			table[class=body] a {
				font-size: 16px !important;
			}

			table[class=body] .wrapper,
			table[class=body] .article {
				padding: 10px !important;
			}

			table[class=body] .content {
				padding: 0 !important;
			}

			table[class=body] .container {
				padding: 0 !important;
				width: 100% !important;
			}

			table[class=body] .main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important;
			}

			table[class=body] .btn table {
				width: 100% !important;
			}

			table[class=body] .btn a {
				width: 100% !important;
			}

			table[class=body] .img-responsive {
				height: auto !important;
				max-width: 100% !important;
				width: auto !important;
			}
		}

		/* -------------------------------------
			PRESERVE THESE STYLES IN THE HEAD
		------------------------------------- */
		@media all {
			.ExternalClass {
				width: 100%;
			}

			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height: 100%;
			}

			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}

			.btn-primary table td:hover {
				background-color: #34495e !important;
			}

			.btn-primary a:hover {
				background-color: #34495e !important;
				border-color: #34495e !important;
			}
		}
	</style>
</head>
<body class="">
<table border="0" cellpadding="0" cellspacing="0" class="body">
	<tr>
		<td>&nbsp;</td>
		<td class="container">
			<div class="content">
				<span class="preheader"></span>
				<table style="background: #eaeaea;">
					<tr>
						<td>
							<img src="data:image/png;base64,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"
								 data-filename="logo.png" style="width: 156px;">
						</td>
					</tr>
				</table>
				<table class="main">
					<tr>
						<td class="wrapper">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										@yield('header')
										<br/>
										@yield('content')
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td class="content-block">
                                <span class="apple-link">
                                   {{ \Config::get('app.name') }}
                                </span>
								<br>
							</td>
						</tr>
						<tr>
							<td class="content-block powered-by">
								{{ URL()->to('/') }}
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
</body>
</html>