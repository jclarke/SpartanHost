{if $condlinks.domainreg || $condlinks.domaintrans || $condlinks.domainown}
<div class="well text-center margin-top">
	<h1>{$LANG.domaincheckerchoosedomain}</h1>
	<p>{$LANG.domaincheckerenterdomain}</p>
	<form method="post" action="domainchecker.php">
		<div class="row form-group">
			<div class="col-md-10 col-md-offset-1">
				<input class="form-control input-lg" name="domain" type="text" value="" placeholder="{$LANG.domaincheckerdomainexample}">
			</div>
		</div>
	{if $capatacha}
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<p><small>{$LANG.captchaverify}</small></p>
				{if $capatacha eq "recaptcha"}
						<p>{$recapatchahtml}</p>
				{else}
						<div class="col-md-3 col-md-offset-3">
							<input type="text" name="code" class="form-control input-sm" maxlength="5">
						</div>
						<div class="col-md-6 text-left">
							<img src="includes/verifyimage.php" alt="captcha" style="margin-bottom: 20px;">
						</div>
				{/if}
					</div>
				</div>
			</div>
		</div>
	{/if}
		<div>
			{if $condlinks.domainreg}<input type="submit" value="{$LANG.checkavailability}" class="btn btn-primary btn-lg">{/if} 
			{if $condlinks.domaintrans}<input type="submit" name="transfer" value="{$LANG.domainstransfer}" class="btn btn-success btn-lg">{/if} 
			{if $condlinks.domainown}<input type="submit" name="hosting" value="{$LANG.domaincheckerhostingonly}" class="btn btn-default btn-lg">{/if} 
		</div>
	</form>
</div>
{/if}

<div class="row">
	<div class="col-md-6">
		<h2>{$LANG.navservicesorder}</h2>
		<p>{$LANG.clientareahomeorder}</p>
		<div class="text-right">
			<a href="cart.php" title="{$LANG.clientareahomeorderbtn}" class="btn btn-primary">{$LANG.clientareahomeorderbtn}</a>
		</div>
	</div>
	<div class="col-md-6">
		<h2>{$LANG.manageyouraccount}</h2>
		<p>{$LANG.clientareahomelogin}</p>
		<div class="text-right">
			<a href="clientarea.php" title="{$LANG.clientareahomeloginbtn}" class="btn btn-primary">{$LANG.clientareahomeloginbtn}</a>
		</div>
	</div>
</div>

<div class="page-header">
	<h2>{$LANG.twitterlatesttweets}</h2>
</div>
{literal}
<center>
<a class="twitter-timeline" href="https://twitter.com/SpartanHost" data-widget-id="372779693641986049"></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</center>
{/literal}
