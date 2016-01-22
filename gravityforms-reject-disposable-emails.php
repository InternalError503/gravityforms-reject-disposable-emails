<?php
/*
Plugin Name: Gravity Forms - Reject Disposable Email Addresses
Plugin URI: https://github.com/ethanpil/gravityforms-reject-disposable-emails
Description: Invalidate email addresses from disposable email services.
Version: 1.2
Author: Angeles Web Design
Author URI: http://angeleswebdesign.com
Contributor: Toady@8pecxstudios
License: GPL
Text Domain: gravityforms-reject-disposable-emails
*/

add_filter('gform_validation', 'invalidate_disposable_emails', 10, 2);

function invalidate_disposable_emails($validation_result)
{

	// Get the form object from the validation result
	$form = $validation_result["form"];
	
	//Loop through the form fields
	foreach($form['fields'] as &$field)
	{
	
		if ($field["type"] == 'email')
		{
			// Get the submitted value from the $_POST
			$field_value = rgpost("input_{$field['id']}");

			//Fail the validation for the entire form if null or empty
			if ($field_value === NULL || empty($field_value)){
				$field['failed_validation'] = true;
        $field['validation_message'] = 'This form does not accept empty email fields.';
				return $validation_result; 
			}

			if (check_email_blacklist($field_value) == 1) 
			{
				//Bad Email
		
				//Fail the validation for the entire form
				$validation_result['is_valid'] = false;
				
				//Mark the specific field that failed and add a custom validation message
				$field['failed_validation'] = true;
				$field['validation_message'] = 'This form does not accept disposable email addresses.';
				
				//Assign our modified $form object back to the validation result
				$validation_result['form'] = $form;
			}
			else 
			{
				//Good Email
				continue;			}
		}
		else 
		{
			//Not an email field, move on
			continue;
		}
	}	
	//Return the validation result
	return $validation_result;
}

function check_email_blacklist ($email) {

	$blacklist = array(
		"0-mail.com",
		"0815.ru",
		"0clickemail.com",
		"0wnd.net",
		"0wnd.org",
		"10minutemail.co.za",
		"10minutemail.com",
		"20minutemail.com",
		"123-m.com",
		"1fsdfdsfsdf.tk",
		"1pad.de",
		"21cn.com",
		"2fdgdfgdfgdf.tk",
		"2prong.com",
		"30minutemail.com",
		"33mail.com",
		"3trtretgfrfe.tk",
		"3d-painting.com",
		"4gfdsgfdgfd.tk",
		"4warding.com",
		"4warding.net",
		"4warding.org",
		"5ghgfhfghfgh.tk",
		"6hjgjhgkilkj.tk",
		"6paq.com",
		"60minutemail.com",
		"675hosting.com",
		"675hosting.net",
		"675hosting.org",
		"6url.com",
		"75hosting.com",
		"75hosting.net",
		"75hosting.org",
		"7tags.com",
		"9ox.net",
		"a-bc.net",
		"abyssmail.com",
		"agedmail.com",
		"ama-trade.de",
		"afrobacon.com",
		"ajaxapp.net",
		"amilegit.com",
		"amiri.net",
		"amiriindustries.com",
		"anappthat.com",
		"anonmails.de",
		"anonbox.net",
		"anonymbox.com",
		"antichef.com",
		"antichef.net",
		"antireg.ru",
		"antispam.de",
		"antispammail.de",
		"armyspy.com",
		"artman-conception.com",
		"azmeil.tk",
		"baxomale.ht.cx",
		"beefmilk.com",
		"bigstring.com",
		"binkmail.com",
		"bio-muesli.net",
		"bobmail.info",
		"bodhi.lawlita.com",
		"bofthew.com",
		"bootybay.de",
		"boun.cr",
		"bouncr.com",
		"breakthru.com",
		"brefmail.com",
		"broadbandninja.com",
		"bsnow.net",
		"bspamfree.org",
		"bugmenot.com",
		"bund.us",
		"burstmail.info",
		"buymoreplays.com",
		"bumpymail.com",
		"byom.de",
		"c2.hu",
		"card.zp.ua",
		"casualdx.com",
		"cek.pm",
		"centermail.com",
		"centermail.net",
		"chammy.info",
		"childsavetrust.org",
		"chogmail.com",
		"choicemail1.com",
		"clixser.com",
		"cmail.net",
		"cmail.org",
		"coldemail.info",
		"cool.fr.nf",
		"correo.blogos.net",
		"cosmorph.com",
		"courriel.fr.nf",
		"courrieltemporaire.com",
		"crapmail.org",
		"cubiclink.com",
		"curryworld.de",
		"cust.in",
		"cuvox.de",
		"d3p.dk",
		"dacoolest.com",
		"dandikmail.com",
		"dayrep.com",
		"dcemail.com",
		"deadaddress.com",
		"deadspam.com",
		"delikkt.de",
		"despam.it",
		"despammed.com",
		"devnullmail.com",
		"dfgh.net",
		"digitalsanctuary.com",
		"dingbone.com",
		"discardmail.com",
		"discardmail.de",
		"Disposableemailaddresses:emailmiser.com",
		"disposableaddress.com",
		"disposableemailaddresses.com",
		"disposableinbox.com",
		"dispose.it",
		"disposeamail.com",
		"disposemail.com",
		"dispostable.com",
		"dm.w3internet.co.ukexample.com",
		"dodgeit.com",
		"dodgit.com",
		"dodgit.org",
		"donemail.ru",
		"dontreg.com",
		"dontsendmespam.de",
		"drdrb.net",
		"dropmail.me",
		"dump-email.info",
		"dumpandjunk.com",
		"dumpmail.de",
		"dumpyemail.com",
		"e-mail.com",
		"e-mail.org",
		"e4ward.com",
		"easytrashmail.com",
		"einmalmail.de",
		"einrot.com",
		"eintagsmail.de",
		"emailgo.de",
		"email60.com",
		"emaildienst.de",
		"emailias.com",
		"emaillime.com",
		"emailigo.de",
		"emailinfive.com",
		"emailmiser.com",
		"emailsensei.com",
		"emailtemporanea.com",
		"emailtemporanea.net",
		"emailtemporar.ro",
		"emailtemporario.com.br",
		"emailthe.net",
		"emailtmp.com",
		"emailto.de",
		"emailwarden.com",
		"emailx.at.hm",
		"emailxfer.com",
		"emeil.in",
		"emeil.ir",
		"emz.net",
		"ero-tube.org",
		"evopo.com",
		"enterto.com",
		"ephemail.net",
		"etranquil.com",
		"etranquil.net",
		"etranquil.org",
		"explodemail.com",
		"express.net.ua",
		"eyepaste.com",
		"fakeinbox.com",
		"fakeinformation.com",
		"fansworldwide.de",
		"fantasymail.de",
		"fightallspam.com",
		"fastacura.com",
		"fastchevy.com",
		"fastchrysler.com",
		"fastkawasaki.com",
		"fastmazda.com",
		"fastmitsubishi.com",
		"fastnissan.com",
		"fastsubaru.com",
		"fastsuzuki.com",
		"fasttoyota.com",
		"fastyamaha.com",
		"filzmail.com",
		"fivemail.de",
		"fleckens.hu",
		"fizmail.com",
		"fr33mail.info",
		"frapmail.com",
		"friendlymail.co.uk",
		"fuckingduh.com",
		"fudgerub.com",
		"fyii.de",
		"front14.org",
		"fux0ringduh.com",
		"garliclife.com",
		"gehensiemirnichtaufdensack.de",
		"get1mail.com",
		"get2mail.fr",
		"getairmail.com",
		"getmails.eu",
		"getonemail.com",
		"giantmail.de",
		"getonemail.net",
		"ghosttexter.de",
		"girlsundertheinfluence.com",
		"gishpuppy.com",
		"gmial.com",
		"goemailgo.com",
		"gotmail.net",
		"gotmail.org",
		"gotti.otherinbox.com",
		"gowikibooks.com",
		"gowikicampus.com",
		"gowikicars.com",
		"gowikifilms.com",
		"gowikigames.com",
		"gowikimusic.com",
		"gowikinetwork.com",
		"gowikitravel.com",
		"gowikitv.com",
		"great-host.in",
		"greensloth.com",
		"grr.la",
		"gsrv.co.uk",
		"guerillamail.biz",
		"guerillamail.com",
		"guerillamail.net",
		"guerillamail.org",
		"guerrillamail.biz",
		"guerrillamail.com",
		"guerrillamail.de",
		"guerrillamail.info",
		"guerrillamail.net",
		"guerrillamail.org",
		"guerrillamailblock.com",
		"gustr.com",
		"harakirimail.com",
		"hat-geld.de",
		"h.mintemail.com",
		"h8s.org",
		"haltospam.com",
		"hatespam.org",
		"herp.in",
		"hidemail.de",
		"hidzz.com",
		"hmamail.com",
		"hopemail.biz",
		"ieh-mail.de",
		"ikbenspamvrij.nl",
		"hochsitze.com",
		"hotpop.com",
		"hulapla.de",
		"ieatspam.eu",
		"ieatspam.info",
		"ihateyoualot.info",
		"iheartspam.org",
		"imails.info",
		"inbax.tk",
		"inbox.si",
		"inboxalias.com",
		"inboxclean.com",
		"inboxclean.org",
		"infocom.zp.ua",
		"instant-mail.de",
		"ip6.li",
		"incognitomail.com",
		"incognitomail.net",
		"incognitomail.org",
		"insorg-mail.info",
		"ipoo.org",
		"irish2me.com",
		"iwi.net",
		"jetable.com",
		"jetable.fr.nf",
		"jetable.net",
		"jetable.org",
		"jnxjn.com",
		"jourrapide.com",
		"jsrsolutions.com",
		"junk1e.com",
		"kasmail.com",
		"kaspop.com",
		"keepmymail.com",
		"killmail.com",
		"killmail.net",
		"kir.ch.tc",
		"klassmaster.com",
		"klassmaster.net",
		"klzlk.com",
		"koszmail.pl",
		"kulturbetrieb.info",
		"kurzepost.de",
		"lawlita.com",
		"letthemeatspam.com",
		"lhsdv.com",
		"lifebyfood.com",
		"link2mail.net",
		"litedrop.com",
		"lol.ovpn.to",
		"lolfreak.net",
		"lookugly.com",
		"lopl.co.cc",
		"lortemail.dk",
		"lr78.com",
		"lroid.com",
		"lukop.dk",
		"m21.cc",
		"mail-filter.com",
		"m4ilweb.info",
		"maboard.com",
		"mail-temporaire.fr",
		"mail.by",
		"mail.mezimages.net",
		"mail.zp.ua",
		"mail1a.de",
		"mail21.cc",
		"mail2rss.org",
		"mail333.com",
		"mail4trash.com",
		"mailbidon.com",
		"mailbiz.biz",
		"mailblocks.com",
		"mailbucket.org",
		"mailcat.biz",
		"mailcatch.com",
		"mailde.de",
		"mailde.info",
		"maildrop.cc",
		"maildx.com",
		"mailed.ro",
		"maileimer.de",
		"maileater.com",
		"mailexpire.com",
		"mailfa.tk",
		"mailforspam.com",
		"mailfreeonline.com",
		"mailguard.me",
		"mailin8r.com",
		"mailinater.com",
		"mailinator.com",
		"mailinator.net",
		"mailinator.org",
		"mailinator2.com",
		"mailincubator.com",
		"mailismagic.com",
		"mailme.ir",
		"mailme.lv",
		"mailme24.com",
		"mailmetrash.com",
		"mailmoat.com",
		"mailms.com",
		"mailnator.com",
		"mailnesia.com",
		"mailnull.com",
		"mailorg.org",
		"mailpick.biz",
		"mailrock.biz",
		"mailscrap.com",
		"mailshell.com",
		"mailsiphon.com",
		"mailtemp.info",
		"mailtome.de",
		"mailtothis.com",
		"mailtrash.net",
		"mailtv.net",
		"mailtv.tv",
		"mailslite.com",
		"mailzilla.com",
		"makemetheking.com",
		"manybrain.com",
		"mailzilla.org",
		"mbx.cc",
		"mega.zik.dj",
		"meinspamschutz.de",
		"meltmail.com",
		"messagebeamer.de",
		"mezimages.net",
		"ministry-of-silly-walks.de",
		"mierdamail.com",
		"mintemail.com",
		"misterpinball.de",
		"mohmal.com",
		"moburl.com",
		"moncourrier.fr.nf",
		"monemail.fr.nf",
		"monmail.fr.nf",
		"monumentmail.com",
		"msa.minsmail.com",
		"mt2009.com",
		"mt2014.com",
		"mycard.net.ua",
		"mx0.wwwnew.eu",
		"mycleaninbox.net",
		"mymail-in.net",
		"mypacks.net",
		"mypartyclip.de",
		"myphantomemail.com",
		"mysamp.de",
		"mytempemail.com",
		"mytempmail.com",
		"myspaceinc.com",
		"myspaceinc.net",
		"myspaceinc.org",
		"myspacepimpedup.com",
		"myspamless.com",
		"mytrashmail.com",
		"nabuma.com",
		"neomailbox.com",
		"nepwk.com",
		"nervmich.net",
		"nervtmich.net",
		"netmails.com",
		"netmails.net",
		"netzidiot.de",
		"neverbox.com",
		"nice-4u.com",
		"nincsmail.hu",
		"nnh.com",
		"no-spam.ws",
		"noblepioneer.com",
		"nomail.pw",
		"nobulk.com",
		"noclickemail.com",
		"nogmailspam.info",
		"nomail.xl.cx",
		"nomail2me.com",
		"nomorespamemails.com",
		"nospam.ze.tc",
		"nospam4.us",
		"nospamfor.us",
		"nospammail.net",
		"nospamthanks.info",
		"notmailinator.com",
		"nowhere.org",
		"nowmymail.com",
		"nurfuerspam.de",
		"nus.edu.sg",
		"nwldx.com",
		"objectmail.com",
		"obobbo.com",
		"odnorazovoe.ru",
		"oneoffemail.com",
		"onewaymail.com",
		"onlatedotcom.info",
		"online.ms",
		"opayq.com",
		"oopi.org",
		"ordinaryamerican.net",
		"otherinbox.com",
		"ourklips.com",
		"outlawspam.com",
		"ovpn.to",
		"owlpic.com",
		"pancakemail.com",
		"pcusers.otherinbox.com",
		"pimpedupmyspace.com",
		"pjjkp.com",
		"plexolan.de",
		"politikerclub.de",
		"poofy.org",
		"pookmail.com",
		"privacy.net",
		"privatdemail.net",
		"proxymail.eu",
		"prtnx.com",
		"putthisinyourspamdatabase.com",
		"pwrby.com",
		"punkass.com",
		"PutThisInYourSpamDatabase.com",
		"qq.com",
		"quickinbox.com",
		"rcpt.at",
		"reallymymail.com",
		"realtyalerts.ca",
		"recode.me",
		"recursor.net",
		"reliable-mail.com",
		"rhyta.com",
		"regbypass.com",
		"rejectmail.com",
		"rklips.com",
		"rmqkr.net",
		"royal.net",
		"rppkn.com",
		"rtrtr.com",
		"s0ny.net",
		"safe-mail.net",
		"safersignup.de",
		"safetymail.info",
		"safetypost.de",
		"sandelf.de",
		"saynotospams.com",
		"schafmail.de",
		"schrott-email.de",
		"secretemail.de",
		"secure-mail.biz",
		"senseless-entertainment.com",
		"services391.com",
		"selfdestructingmail.com",
		"SendSpamHere.com",
		"sharklasers.com",
		"shieldemail.com",
		"shiftmail.com",
		"shitmail.me",
		"shitware.nl",
		"shmeriously.com",
		"shortmail.net",
		"sibmail.com",
		"sinnlos-mail.de",
		"slapsfromlastnight.com",
		"skeefmail.com",
		"slaskpost.se",
		"slipry.net",
		"smashmail.de",
		"slopsbox.com",
		"smellfear.com",
		"snakemail.com",
		"sneakemail.com",
		"sneakmail.de",
		"snkmail.com",
		"sofimail.com",
		"sofort-mail.de",
		"sogetthis.com",
		"solvemail.info",
		"soodonims.com",
		"spam4.me",
		"spamail.de",
		"spamarrest.com",
		"spam.la",
		"spam.su",
		"spamavert.com",
		"spambob.com",
		"spambob.net",
		"spambob.org",
		"spambog.com",
		"spambog.de",
		"spambog.ru",
		"spambox.info",
		"spambox.irishspringrealty.com",
		"spambox.us",
		"spamcannon.com",
		"spamcannon.net",
		"spamcero.com",
		"spamcon.org",
		"spamcorptastic.com",
		"spamcowboy.com",
		"spamcowboy.net",
		"spamcowboy.org",
		"spamday.com",
		"spamex.com",
		"spamfree.eu",
		"spamfree24.com",
		"spamfree24.de",
		"spamfree24.eu",
		"spamfree24.info",
		"spamfree24.net",
		"spamfree24.org",
		"spamgoes.in",
		"spamgourmet.com",
		"spamgourmet.net",
		"spamgourmet.org",
		"spamherelots.com",
		"spamhereplease.com",
		"SpamHereLots.com",
		"SpamHerePlease.com",
		"spamhole.com",
		"spamify.com",
		"spaminator.de",
		"spamkill.info",
		"spaml.com",
		"spaml.de",
		"spammotel.com",
		"spamobox.com",
		"spamoff.de",
		"spamslicer.com",
		"spamspot.com",
		"spamstack.net",
		"spamthis.co.uk",
		"spamtroll.net",
		"spamthisplease.com",
		"spamtrail.com",
		"speed.1s.fr",
		"spoofmail.de",
		"stuffmail.de",
		"super-auswahl.de",
		"supergreatmail.com",
		"supermailer.jp",
		"superrito.com",
		"superstachel.de",
		"suremail.info",
		"talkinator.com",
		"teewars.org",
		"teleworm.com",
		"teleworm.us",
		"temp-mail.org",
		"temp-mail.ru",
		"tempalias.com",
		"tempe-mail.com",
		"tempemail.co.za",
		"tempemail.biz",
		"tempemail.com",
		"tempemail.net",
		"TempEMail.net",
		"tempinbox.co.uk",
		"tempinbox.com",
		"tempmail.eu",
		"tempmaildemo.com",
		"tempmailer.com",
		"tempmailer.de",
		"tempmail.it",
		"tempmail2.com",
		"tempomail.fr",
		"temporarily.de",
		"temporarioemail.com.br",
		"temporaryemail.net",
		"temporaryforwarding.com",
		"temporaryinbox.com",
		"temporarymailaddress.com",
		"tempthe.net",
		"thanksnospam.info",
		"thankyou2010.com",
		"thc.st",
		"thelimestones.com",
		"thisisnotmyrealemail.com",
		"thismail.net",
		"throwawayemailaddress.com",
		"tilien.com",
		"tittbit.in",
		"tizi.com",
		"tmailinator.com",
		"toomail.biz",
		"topranklist.de",
		"tradermail.info",
		"trash-amil.com",
		"trash-mail.at",
		"trash-mail.com",
		"trash-mail.de",
		"trash2009.com",
		"trashdevil.com",
		"trashemail.de",
		"trashmail.at",
		"trashmail.com",
		"trashmail.de",
		"trashmail.me",
		"trashmail.net",
		"trashmail.org",
		"trashmail.ws",
		"trashmailer.com",
		"trashymail.com",
		"trbvm.com",
		"trialmail.de",
		"trashymail.net",
		"trillianpro.com",
		"tryalert.com",
		"turual.com",
		"twinmail.de",
		"tyldd.com",
		"uggsrock.com",
		"umail.net",
		"uroid.com",
		"us.af",
		"upliftnow.com",
		"uplipht.com",
		"venompen.com",
		"veryrealemail.com",
		"viditag.com",
		"viralplays.com",
		"vpn.st",
		"vsimcard.com",
		"vubby.com",
		"wasteland.rfc822.org",
		"webemail.me",
		"weg-werf-email.de",
		"wegwerf-emails.de",
		"viewcastmedia.com",
		"viewcastmedia.net",
		"viewcastmedia.org",
		"walkmail.net",
		"webm4il.info",
		"wegwerfadresse.de",
		"wegwerfemail.com",
		"wegwerfemail.de",
		"wegwerfmail.de",
		"wegwerfmail.info",
		"wegwerfmail.net",
		"wegwerfmail.org",
		"wetrainbayarea.com",
		"wetrainbayarea.org",
		"wh4f.org",
		"whyspam.me",
		"willhackforfood.biz",
		"willselfdestruct.com",
		"winemaven.info",
		"wronghead.com",
		"wuzup.net",
		"wuzupmail.net",
		"www.e4ward.com",
		"www.gishpuppy.com",
		"www.mailinator.com",
		"wwwnew.eu",
		"x.ip6.li",
		"xagloo.com",
		"xemaps.com",
		"xents.com",
		"xmaily.com",
		"xoxy.net",
		"yep.it",
		"yogamaven.com",
		"yopmail.com",
		"yopmail.fr",
		"yopmail.net",
		"yourdomain.com",
		"ypmail.webarnak.fr.eu.org",
		"yuurok.com",
		"z1p.biz",
		"za.com",
		"zehnminuten.de",
		"zehnminutenmail.de",
		"zippymail.info",
		"zoemail.net",
		"zomg.info",
		"zoaxe.com",
		"zoemail.org"
	);
	
	$email_split = explode('@', $email); 
	$email_domain = strtolower($email_split[1]);
	
	if (in_array($email_domain, $blacklist)) 
	{    
		//disposable email detected     
		return 1;
	}     
	else
	{
		//No match found
		return 0;     
	}
	
}
?>
