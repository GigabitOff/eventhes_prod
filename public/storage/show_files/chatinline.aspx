

   	// livechat by www.mylivechat.com/  2018-06-12

   	
	   // first loading
	   if (typeof (MyLiveChat) == "undefined") {
		   MyLiveChat = {};
		   MyLiveChat.RawConfig ={InlineChatHideSubject:"1",InlineChatRoundOffline:"18",SoundInvitationVolume:"19.00",InlineTriggerDefinition:"[]",WidgetHideWidget:"",InviteHideTimeout:"7200",InlineChatRoundPadding:"",InlineChatRoundMargin:"",InlineChatRoundRadius:"99",InlineChatRoundSize:"32",InviteTemplate:"5",InlineChatRoundOnlineUrl:"",SoundVisitor:"online",InlineChatBubbleUIMode:"1",InPageImageOffline:"1",InviteHeadline:"Chat Invitation",InviteSoundFile:"1",InvitePlaySound:"0",SoundRequestVolume:"25.00",SoundJoin:"online",InviteMessage:"Happy 2021:\x0A\x0ADon\x27t miss our NEW YEAR COUPON with a 40% Discount \x22Hello2021\x22 on ALL Laraship platforms!\x0A\x0Ahttps://www.laraship.com/store/",InlineChatRoundFontSize:"18px",InPageImageOnline:"1",SoundMessage:"msn_message",InlineChatRoundBackColor:"#3e29d1",SoundRequest:"ring",WebConsoleRedirectTime:"637666948871174055",UIMobileMode:"Inline",WidgetOnlineImage:"4",InPageTemplate:"15",WidgetOpenNewWindow:"True",SoundNudge:"msn_nudge",InlineChatRoundOfflineUrl:"",InlineChatRoundSpace:"15",WidgetHideInline:"",InPageUseBubbleTop:"0",WidgetFixedMode:"",InlineChatOfflineLogo:"upload",SoundMessageVolume:"39.00",InPagePosition:"middleright",InviteAcceptTooltip:"Chat Invitation",SoundJoinVolume:"48.00",InPageBubbleTop:"1",InlineChatRoundOfflineGray:"N",InlineChatOnlineLogo:"upload",SoundNudgeVolume:"27.00",InviteRejectTooltip:"Close",InlineChatWaitingFieldDepartment:"0",InlineChatButtonMode:"round",InPageUseBubbleTopOnlineOnly:"0",SoundVisitorVolume:"38.00",SoundInvitation:"alarm"};
		   MyLiveChat.RawQuery ={hccid:"29741647",apimode:"chatinline"};
		   for (var mlcp in MyLiveChat.RawConfig) {
			   MyLiveChat[mlcp] = MyLiveChat.RawConfig[mlcp];
		   }
		   for (var mlcp in MyLiveChat.RawQuery) {
			   MyLiveChat[mlcp] = MyLiveChat.RawQuery[mlcp];
		   }

		   MyLiveChat.HCCID ='29741647';
		   MyLiveChat.PageBeginTime = new Date().getTime();
		   MyLiveChat.LoadingHandlers = [];
		   //	,"Departments"
		   MyLiveChat.CPRFIELDS = ["SyncType", "SyncStatus", "SyncResult", "HasReadyAgents", "VisitorUrls", "VisitorStatus", "VisitorDuration", "VisitorEntryUrl", "VisitorReferUrl"];

		   MyLiveChat.DefaultFont = "Poppins";

		   (function () {
			   function loadfont(font) {
				   var fonturl = "https://fonts.googleapis.com/css?family=" + encodeURIComponent(font) + ":300,400,500,600,700";

				   var div = document.createElement('div');
				   div.style.cssText = "position:fixed;left:-1000px;";
				   div.style.fontFamily = '"' + font + '"';
				   div.innerText = "a";
				   try {
					   document.body.appendChild(div);
				   } catch (x) {
					   var head = document.getElementsByTagName("head")[0]
					   try {
						   head.appendChild(div);
					   } catch (x) {
						   head.insertBefore(div, head.firstChild);
					   }
				   }

				   var link = MyLiveChat_ImportCss(fonturl);
				   link.onload = function () {
					   setTimeout(function () {
						   document.body.removeChild(div);
					   }, 100)
				   }

			   }
			   var fonts = ["Poppins"];
			   try {
				   for (var p in MyLiveChat.RawConfig) {
					   var fontval;
					   if (/Font$/.test(p)) {
						   fontval = MyLiveChat.RawConfig[p];
					   }
					   if (/TextStyle$/.test(p)) {
						   var ts = MyLiveChat.RawConfig[p];
						   if (ts) {
								//ts = "test:123;" + ts + ";another:222";
							   var ms = /font-family:([^;]+)/.exec(ts);
							   if (ms)fontval = ms[1];
						   }
					   }
					   if (!fontval || fonts.indexOf(fontval) != -1)
						   continue;
					   //console.log(fontval)
					   switch (fontval) {
						   case "Poppins":
						   case "Open Sans":
						   case "Noto Sans":
						   case "Lato":
						   case "Lora":
						   case "Roboto":
						   case "proxima-nova":
							   fonts.push(fontval);
							   break;
					   }
				   }
			   } catch (x) {
				   console.error(x);
			   }
			   for (var i = 0; i < fonts.length; i++) {
				   loadfont(fonts[i])
			   }
		   })();
	   }
	   else {
		   MyLiveChat.MultiLinked = true;
	   }
	


	   MyLiveChat.Version =3017;
	   MyLiveChat.FirstRequestTimeout =28800;
	   MyLiveChat.NextRequestTimeout =57600;
	   MyLiveChat.SyncType =null;
	   MyLiveChat.SyncStatus ="LOADING";
	   MyLiveChat.SyncUserName =null;
	   MyLiveChat.SyncResult ="LOADING";
	   MyLiveChat.HasReadyAgents =false;
	   MyLiveChat.SourceUrl ="https://reservation2.laraship.com/";
	   MyLiveChat.AgentTimeZone = parseInt("3" || "-5");
	   MyLiveChat.VisitorStatus ="";
	   MyLiveChat.UrlBase ="https://t2.mylivechat.com/livechat2/";
	   MyLiveChat.SiteUrl ="https://t2.mylivechat.com/";

   	

	   if (!MyLiveChat.AgentId) MyLiveChat.AgentId = MyLiveChat.RawAgentId;

	   MyLiveChat.Departments = [];

	   MyLiveChat.Departments.push({
		   Name:"Default",
		   Agents: [{
			   Id:'User:1',
			   Name:"Laraship",
			   Online:false
   			}],
		   Online:false
   		});



	   MyLiveChat.VisitorUrls = [];



   	

	   function MyLiveChat_AddScript(tag) {
		   var func = MyLiveChat_AddScript;
		   var arr = func._list;
		   if (!arr) func._list = arr = [];
		   if (func._loading) {
			   arr.push(tag);
			   return;
		   }
		   function ontagload() {
			   func._loading = false;
			   if (!arr.length) return;
			   tag = arr.shift();
			   LoadTag();
		   }
		   function LoadTag() {
			   func._loading = true;
			   if ('onload' in tag) {
				   tag.onload = ontagload;
			   }
			   else {
				   var iid = setInterval(function () {
					   if (tag.readyState != 'complete' && tag.readyState != 'loaded')
						   return;
					   clearInterval(iid);
					   ontagload();
				   }, 10);
			   }
			   var p = document.getElementsByTagName("head")[0] || document.body;
			   p.insertBefore(tag, p.firstChild);
		   }
		   LoadTag();
	   }

	   function MyLiveChat_GetLastScriptTag() {
		   var coll = document.getElementsByTagName("script");
		   return coll[coll.length - 1];
	   }
	   function MyLiveChat_ImportCss(url,tagid) {
		   var p = document.head || document.getElementsByTagName("head")[0] || document.body;
		   var tag = document.createElement("link");
		   if (tagid) tag.setAttribute("id", tagid);
		   tag.setAttribute("rel", "stylesheet");
		   tag.setAttribute("href", url);
		   p.insertBefore(tag, p.firstChild);
		   return tag;
	   }
	   function MyLiveChat_DocWrite(html, relativetag) {
		   if (html.substr(0, 7) == "<script")	//Low IE interactive or defer
		   {
			   var src = html.match(/src=["']?([^"'>]*)["']/)[1];
			   if (!MyLiveChat.LoadedScripts) MyLiveChat.LoadedScripts = {};
			   if (MyLiveChat.LoadedScripts[src]) return;
			   MyLiveChat.LoadedScripts[src] = true;

			   var tag = document.createElement("script");
			   tag.setAttribute("src", src);
			   MyLiveChat_AddScript(tag);
		   }
		   else {
			   if (!document.body || document.readyState == "loading") {
				   document.write(html);
				   return;
			   }

			   if (!relativetag) relativetag = MyLiveChat_GetLastScriptTag();
			   var div = document.createElement("DIV");
			   div.innerHTML = html;
			   while (true) {
				   var c = div.firstChild;
				   if (!c) break;
				   div.removeChild(c);
				   relativetag.parentNode.insertBefore(c, relativetag);
			   }
		   }
	   }

	   MyLiveChat.RandomID = 'ed01ac2e-c962-c9eb-0225-3d339a39dc08';


	   MyLiveChat.NewGuid = function () {
		   var guid = "";
		   for (var i = 1; i <= 32; i++) {
			   guid += Math.floor(Math.random() * 16.0).toString(16);
			   if (i == 8 || i == 12 || i == 16 || i == 20) guid += "-";
		   }
		   return guid;
	   }

	   MyLiveChat.RandomID = MyLiveChat.NewGuid().substring(0, 18) + MyLiveChat.RandomID.substring(18);


   	

	   MyLiveChat.VisitorDuration = 0;
	   MyLiveChat.VisitorEntryUrl = "";
	   MyLiveChat.VisitorReferUrl = "";

	   MyLiveChat.ShowButton =true;
	   MyLiveChat.ShowLink =true;
	   MyLiveChat.ShowBox =true;
	   MyLiveChat.ShowSmart =false;


	   MyLiveChat.NoPrivateLabel =true;


	   MyLiveChat.LoadingHandlers.push(function (funcself) {
		   MyLiveChat_RunLoadingHandler('chatinline', funcself);
	   });

	   MyLiveChat.ResourcesVary ="\x26culture=ru-UA\x26mlcv=3017\x26template=15";

   	

   	

	   MyLiveChat['chatinline' + "_script_tag"] = MyLiveChat_GetLastScriptTag();

	   if (typeof (MyLiveChat_Initialize) != "undefined") {
		   MyLiveChat_Initialize()
	   }
	   else if (!MyLiveChat.MultiLinked) {
		   MyLiveChat_ImportCss(MyLiveChat.UrlBase + "chatinline.css?" + MyLiveChat.ResourcesVary,"mlc_chatinlie_styletag");
		   MyLiveChat_DocWrite("<script defer='defer' src='" + MyLiveChat.UrlBase + "resources2.aspx?HCCID=" + MyLiveChat.HCCID + MyLiveChat.ResourcesVary + "'></scr" + "ipt>");
		   MyLiveChat_DocWrite("<script defer='defer' src='" + MyLiveChat.UrlBase + "script/livechatinit2.js'></scr" + "ipt>");
	   }


   	