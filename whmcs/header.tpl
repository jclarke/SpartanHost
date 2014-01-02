<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="content-type" content="text/html; charset={$charset}" />
	<title>{if $kbarticle.title}{$kbarticle.title} - {/if}{$pagetitle} - {$companyname}</title>
	{if $livehelpjs}{$livehelpjs}
	{/if}
	<link href="templates/{$template}/css/whmcs.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,300|Oswald:300' rel='stylesheet' type='text/css'>
	<link href="templates/{$template}/css/style.css" rel="stylesheet">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="templates/{$template}/js/whmcs.js"></script>

	{$headoutput}

	</head>

	<body>
	<!--Start of Zopim Live Chat Script-->
	{literal}<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
	$.src='//v2.zopim.com/?1GsTVWooV1Sx6Q4uCrt4xLs1t67Qwdma';z.t=+new Date;$.
	type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
	</script>{/literal}
{$headeroutput}
	<div class="pagetrimmer">
		<div class="container">
			<nav class="main"> 
				<a class="navbar-brand col-md-2" href="http://spartanhost.net">SpartanHost</a>
				<div class="col-md-7">	
					<ul class="nav navbar-nav navbar-right white bar">
						<li><a href="http://spartanhost.net">Home</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Plans <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="https://billing.spartanhost.net/cart.php?gid=3">Budget Minecraft Plans</a></li>
								<li><a href="https://billing.spartanhost.net/cart.php?gid=1">Premium Minecraft Plans</a></li>
								<li><a href="https://billing.spartanhost.net/cart.php?gid=8">Dedicated Server Plans</a></li>
								<li><a href="https://billing.spartanhost.net/cart.php?gid=7">DDoS Protection Plans</a></li>
								<li><a href="https://billing.spartanhost.net/cart.php?gid=2">Web Hosting Plans</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Support <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="http://spartanhost.net/faq">FAQ</a></li>
								<li><a href="https://billing.spartanhost.net/">Client Area</a></li>
								<li><a href="https://billing.spartanhost.net/contact.php">Contact Us</a></li>
								<li><a href="http://spartanhost.net/irc">IRC Chat</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="nav navbar-nav red bar">
						<li><a href="http://cp.spartanhost.net/">Multicraft</a></li>
						<li><a href="https://billing.spartanhost.net/">Client Area</a></li>
					</ul>
				</div>
			</nav>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<nav class="navbar navbar-sub">
			<ul class="nav navbar-nav">
				<li><a href="{if $loggedin}clientarea{else}index{/if}.php">{$LANG.hometitle}</a></li>
	{if $loggedin}
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$LANG.navservices}&nbsp;<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="clientarea.php?action=products">{$LANG.clientareanavservices}</a></li>
					{if $condlinks.pmaddon}<li><a href="index.php?m=project_management">{$LANG.clientareaprojects}</a></li>{/if}
					<li class="divider"></li>
					<li><a href="cart.php">{$LANG.navservicesorder}</a></li>
					<li><a href="cart.php?gid=addons">{$LANG.clientareaviewaddons}</a></li>
				</ul>
			</li>


				{if $condlinks.domainreg || $condlinks.domaintrans}
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$LANG.navdomains}&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="clientarea.php?action=domains">{$LANG.clientareanavdomains}</a></li>
					<li class="divider"></li>
					<li><a href="cart.php?gid=renewals">{$LANG.navrenewdomains}</a></li>
					{if $condlinks.domainreg}<li><a href="cart.php?a=add&domain=register">{$LANG.navregisterdomain}</a></li>{/if}
					{if $condlinks.domaintrans}<li><a href="cart.php?a=add&domain=transfer">{$LANG.navtransferdomain}</a></li>{/if}
					{if $enomnewtldsenabled}<li><a href="index.php?m=enomnewtlds">Preregister New TLDs</a></li>{/if}
					<li class="divider"></li>
					<li><a href="domainchecker.php">{$LANG.navwhoislookup}</a></li>
					</ul>
				</li>{/if}
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$LANG.navbilling}&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="clientarea.php?action=invoices">{$LANG.invoices}</a></li>
					<li><a href="clientarea.php?action=quotes">{$LANG.quotestitle}</a></li>
					<li class="divider"></li>
					{if $condlinks.addfunds}<li><a href="clientarea.php?action=addfunds">{$LANG.addfunds}</a></li>{/if}
					{if $condlinks.masspay}<li><a href="clientarea.php?action=masspay&all=true">{$LANG.masspaytitle}</a></li>{/if}
					{if $condlinks.updatecc}<li><a href="clientarea.php?action=creditcard">{$LANG.navmanagecc}</a></li>{/if}
					</ul>
				</li>
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$LANG.navsupport}&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="supporttickets.php">{$LANG.navtickets}</a></li>
					<li><a href="knowledgebase.php">{$LANG.knowledgebasetitle}</a></li>
					<li><a href="downloads.php">{$LANG.downloadstitle}</a></li>
					<li><a href="serverstatus.php">{$LANG.networkstatustitle}</a></li>
					</ul>
				</li>
				<li><a href="submitticket.php">{$LANG.navopenticket}</a></li>
				{if $condlinks.affiliates}<li><a href="affiliates.php">{$LANG.affiliatestitle}</a></li>{/if}
			</ul>

				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$LANG.hello}, {$loggedinuser.firstname}!&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="clientarea.php?action=details">{$LANG.editaccountdetails}</a></li>
					{if $condlinks.updatecc}<li><a href="clientarea.php?action=creditcard">{$LANG.navmanagecc}</a></li>{/if}
					<li><a href="clientarea.php?action=contacts">{$LANG.clientareanavcontacts}</a></li>
					{if $condlinks.addfunds}<li><a href="clientarea.php?action=addfunds">{$LANG.addfunds}</a></li>{/if}
					<li><a href="clientarea.php?action=emails">{$LANG.navemailssent}</a></li>
					<li><a href="clientarea.php?action=changepw">{$LANG.clientareanavchangepw}</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">{$LANG.logouttitle}</a></li>
					</ul>
				</li>
				</ul>
	{else}
				<li><a href="announcements.php">{$LANG.announcementstitle}</a></li>
				<li><a href="knowledgebase.php">{$LANG.knowledgebasetitle}</a></li>
				<li><a href="serverstatus.php">{$LANG.networkstatustitle}</a></li>
				<li><a href="affiliates.php">{$LANG.affiliatestitle}</a></li>
				<li><a href="contact.php">{$LANG.contactus}</a></li>
			</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$LANG.account}&nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="clientarea.php">{$LANG.login}</a></li>
							<li><a href="register.php">{$LANG.register}</a></li>
							<li class="divider"></li>
							<li><a href="pwreset.php">{$LANG.forgotpw}</a></li>
						</ul>
					</li>
				</ul>
	{/if}

			</div>
		</div>
		</div>
	</div>
	<div class="container">
		<div class="pagecontent">

{if $pagetitle eq $LANG.carttitle}<div id="whmcsorderfrm">{/if}