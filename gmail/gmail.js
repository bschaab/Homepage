//username = uiucapitester123
//password = testtest123


    var j = 0;
    var size = 0;
	var messageProcessed = 0;
	var emailFeedGlobal = null;
	var emailNum = 0;

     var clientId = '688997813097-slfbf24164p8vlg1rbmebebl2nmiare7.apps.googleusercontent.com';

      var apiKey = 'AIzaSyAdxB6BEVThZb0DkXGxRkpfgAarjN5yCEU';

	  var scopes = 'https://mail.google.com/';
      function handleClientLoad() {
        // Step 2: Reference the API key
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,1);
      }
		function logOut(){
			alert("HELLO");
		}
      function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
      }
      function handleAuthResult(authResult) {
        var authorizeButton = document.getElementById('authorize-btn');
        	//if the auth is successfull hide the button
        if (authResult && !authResult.error) {
          authorizeButton.style.visibility = 'hidden';
          makeApiCall();
          //if fail show the button
        } else {
          authorizeButton.style.visibility = '';
          authorizeButton.onclick = handleAuthClick;
        }
      }
      function handleAuthClick(event) {
        // Step 3: get authorization to use private data
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        return false;
      }
      // Load the API and make an API call.  Display the results on the screen.
              		var FLAGS = 0;
	  function deleteMessage(messageID){
	        		 gapi.client.gmail.users.messages.delete({
	        	            'userId': 'me',
	        	            'id' : messageID
	       			 });
	}
	function sendMessage(){
		gapi.client.load('gmail', 'v1').then(function() {
		var to = 'hehebandit@gmail.com',
        subject = 'Hello World',
        content = 'send a Gmail.'
  		var email = "From: 'me'\r\n"+
        "To:  "+ to +"\r\n"+
        "Subject: "+subject+"\r\n"+
        "\r\n"+
        content;
		
			
		var message = email;
		
        var base64EncodedEmail = btoa(message).replace(/\//g,'_').replace(/\+/g,'-');
  		var request = gapi.client.gmail.users.messages.send({
        'userId': 'me',
        'message': {
            'raw': base64EncodedEmail
        }
	    }).execute(function(resp){location.reload()});
        
      });
		
		
	}
	
      function makeApiCall() {
        // Step 4: Load the Google+ API
        var bodyArr = [];
        var fromArr = [];
       	var dateArr = [];
       	var snippetArr = [];
       	var emailFeed = [];      	
        gapi.client.load('gmail', 'v1').then(function() {
        gapi.client.gmail.users.getProfile({
            'userId': 'me'
        }).execute(function(resp){ 
        		//console.log(resp);
        	
        	} 
        ); 
        	//console.log("HELLO----------GETTING MESSAGE LIST");
        gapi.client.gmail.users.messages.list({
        	            'userId': 'me'
        }).execute(function(resp){ 
        		//console.log(resp);
        		var total = 5;
        		var j = 0;
				while(size < 5 && j < (resp['messages'].length-2) ){
	        		 gapi.client.gmail.users.messages.get({
	        	            'userId': 'me',
	        	            'id' : resp['messages'][j]['id']
	       			 }).execute(function(resp2){
		       			 	//console.log(resp['messages'][j]['id']); 
		       			 	//console.log(resp2);
		        			if(resp2['payload']['parts'] === undefined){
		        			}
		        			else{
		        			var header = resp2['payload']['headers'];
							var headerLength = header.length;
								
								if(headerLength >= 13){
									var tempObject = parseJsonType13(resp2);
									/*
									btn.onclick = function(){
											 gapi.client.gmail.users.messages.delete({
		        	            			'userId': 'me',
		        	            			'id' : temp
		       								 }).execute(function(resp){
		       								 	location.reload();
		       								 });
	
									};*/
									/*
									header.appendChild(snippet_html);
									p.appendChild(content_html);
									btn.appendChild(deleteZXC);
									//btn.setAttribute("onclick", "deleteMessage(temp);");
							
									var d = document.getElementById("content");																
									d.appendChild(header);
									d.appendChild(p);
									d.appendChild(btn);							
									*/
									//console.log(body);
							        //console.log(snippet);
				        			//console.log(from);

									emailFeed.push(tempObject);
									//console.log(emailFeed.length);
									if(emailFeed.length >= 1){
										processData(emailFeed);
									}
								} //endif header
								else{}
								j = j+1;								
							}			
	        		} //promise close inside
        			);
        	
        			j = j+1;
        			}//while loop
        		
        	}//promise outside
        ); 	
		
          
        });
      }
      
      function parseJsonType13(resp2){		        			
      		var body = resp2['payload']['parts'][0]['body']['data'];
		    body = decode64(body);
		    var snippet = resp2['snippet'];
      		var date = resp2['payload']['headers'][4]['value'];
			var from = resp2['payload']['headers'][13]['value'];
			var title = resp2['payload']['headers'][18]['value'];
			var temp = resp2['id'];
    		date = date.split(';')[1];
			date = new Date(date);
			var tempObject = {
				'body' : body,
				'from' : from,
				'snippet' : snippet,
				'date' : date,
				'title' : title,									
				'id' : temp
			};
			return tempObject;
			
      }
      
		//process the email feeds array
      function processData(emailFeed){
	      	messageProcessed =1;
			var thisDate = new Date(emailFeed[0].date);
			emailFeed.sort(function(a,b){
				var aDate = new Date(a.date);
				var bDate = new Date(b.date);
				return bDate-aDate;			
			});	
      	

      	emailFeedGlobal = emailFeed;
      	createMessage(emailFeed, 0);
      }
      
		      
		function decode64(s) {
			if (s == null) {
				return null;
			}
		    var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
		    var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
		    for(i=0;i<64;i++){e[A.charAt(i)]=i;}
		    for(x=0;x<L;x++){
		        c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
		        while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
		    }
		    return r;
		};
		      
      	//create a message
        function createMessage(emailFeed, emailNum) {
        	if(emailFeed.length != 0){
	        	document.getElementById("emailBody").innerHTML = emailFeed[emailNum]['body'];
	        	var title = emailFeed[emailNum]['title'];
	        	title = JSON.stringify(title);
	        	if (title.length > 30) {
	        		title = title.substring(1, 30);
	        		title += "...";
	        	}
	        	var date = emailFeed[emailNum]['date'];
	 			date = JSON.stringify(date);
	 			date = date.substring(1, 11);
	        	title += " " + "(" + date + ")";
	        	document.getElementById("emailTitle").innerHTML = title;
			}
			else
			{
				document.getElementById("emailBody").innerHTML = "you don't have any messages";
			}
 			
        	       	
  		}

  		function nextMessage(direction) {
  			if (direction == 'right') {
  				if (emailNum < emailFeedGlobal.length) {
  					emailNum += 1; 
  				}

  			}
  			else if (direction == 'left'){
  				if (emailNum >= 1) {
  					emailNum -= 1; 
  				}
  			}

  			createMessage(emailFeedGlobal, emailNum);
  		}

