//username = uiucapitester123
//password = testtest123

    var j = 0;
    var size = 0;
	var messageProcessed = 0;
	var emailFeedGlobal = null;
	var emailNum = 0;
	var FLAGS = 0;

    var clientId = '688997813097-slfbf24164p8vlg1rbmebebl2nmiare7.apps.googleusercontent.com';
    var apiKey = 'AIzaSyAdxB6BEVThZb0DkXGxRkpfgAarjN5yCEU';
	var scopes = 'https://mail.google.com/';
    
	/**
		* Helper function to set the Google API key. 
		*
		* @param {none}
		* @return {none}
	*/  
    function handleClientLoad() {
        // Step 2: Reference the API key
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,1);
    }
	
	/**
		* Helper function for handleAuthResult.  On success, executes the callback
		* handleAuthResult.
		*
		* @param {none}
		* @return {none}
	*/    
    function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
    }

    /**
		* Helper function for handleAuthResult.  On success, executes the callback
		* handleAuthResult.
		*
		* @param {none}
		* @return {false}
	*/   
    function handleAuthClick(event) {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        return false;
    }


    /**
		* This function authorizes the user for gmail, displaying the  
		* inbox if the authorization is successful. 
		* 
		* @param {authResult}
		* @return {none}
	*/
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

    /**
		* Deletes a message in the users inbox.  
		* 
		* 
		* @param {messageID}
		* @return {none}
	*/ 
	function deleteMessage(messageID){
		gapi.client.gmail.users.messages.delete({
	    	'userId': 'me',
	        	'id' : messageID
		});
	}

	/**
		* Sends an email message
		* 
		* @param {none}
		* @return {none}
	*/ 
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


	/**
		* Main function for Google API call.  Loads the Google+ API.  Retreives  
		* the message list by creating the response array with the the following content:
		* bodyArr    -- the body of the message.
		* fromArr    -- the sender of the message.
		* dateArr    -- the date the message was sent. 
		* snippetArr -- a snippet of the message. 
		* @param {none}
		* @return {none}
	*/ 
    function makeApiCall() {
        var bodyArr = [];
        var fromArr = [];
       	var dateArr = [];
       	var snippetArr = [];
       	var emailFeed = [];      	
        gapi.client.load('gmail', 'v1').then(function() {
        gapi.client.gmail.users.getProfile({
            'userId': 'me'
        }).execute(function(resp){} 
        ); 

        gapi.client.gmail.users.messages.list({
        	            'userId': 'me'
        }).execute(function(resp){ 
        		var total = 5;
        		var j = 0;
				while(j < (resp['messages'].length) ){
	        		 gapi.client.gmail.users.messages.get({
	        	            'userId': 'me',
	        	            'id' : resp['messages'][j]['id']
	       			 }).execute(function(resp2){
	       			 		console.log(resp2);
		        			if(resp2['payload']['parts'] === undefined){
		        			}
		        			else{
			        			var header = resp2['payload']['headers'];
								var headerLength = header.length;
			       			 	if(headerLength >= 13){
									var tempObject = parseJsonType13(resp2);


									emailFeed.push(tempObject);
									if(emailFeed.length >= 1){
										processData(emailFeed);
									}
								} 
								else if(headerLength >= 9){
									var tempObject = parseJsonType9(resp2);
									emailFeed.push(tempObject);
									if(emailFeed.length >= 1){
										processData(emailFeed);
									}									
									
								}
								else{}
								j = j+1;								
							}			
	        			});

        				j = j+1;
        			}
        		}
        	); 
   		});
	}


    /**
		* Parses the email message, decoding from 64 to prevent  
		* garbage characters from being shown.
		* 
		* @param {resp2} an array of email content supplied by the google API
		* @return {revisedMessage} 64 decoded email message.
	*/ 
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
			var revisedMessage = {
				'body' : body,
				'from' : from,
				'snippet' : snippet,
				'date' : date,
				'title' : title,									
				'id' : temp
			};
			return revisedMessage;			
      }

    /**
		* Parses the email message, decoding from 64 to prevent  
		* garbage characters from being shown.
		* 
		* @param {resp2} an array of email content supplied by the google API
		* @return {revisedMessage} 64 decoded email message.
	*/ 
    function parseJsonType9(resp2){		        			
      	var body = resp2['payload']['parts'][0]['body']['data'];
		body = decode64(body);
		var snippet = resp2['snippet'];
      	var date = resp2['payload']['headers'][2]['value'];
		var from = resp2['payload']['headers'][6]['value'];
		var title = resp2['payload']['headers'][5]['value'];
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

      
    /**
		* Parses the email message, decoding from 64 to prevent  
		* garbage characters from being shown.
		* 
		* @param {resp2} an array of email content supplied by the google API
		* @return {revisedMessage} 64 decoded email message.
	*/ 
    function processData(emailFeed) {
	    messageProcessed =1;
		var thisDate = new Date(emailFeed[0].date);
		sortData(emailFeed);
	    emailFeedGlobal = emailFeed;
      	
      	createMessage(emailFeed, 0);
    }

    /**
		* Email content is not sorted chronologically by Google by default.
		* This function sorts the emailFeed by the date. 
		*
		* @param {emailFeed} an array of email content supplied by the google API.
		* @return {sorted} the sorted email feed content. 
	*/ 
	function sortData(emailFeed) {
		emailFeed.sort(function(a,b){
			var aDate = new Date(a.date);
			var bDate = new Date(b.date);
			var sorted = bDate-aDate; 

			return sorted;			
		});	
			
	}


    /**
		* Redirects user to the inbox after successful authorization.
		*
		* @param {none} 
		* @return {none}  
	*/ 
    function redirectUser() {
      	if(emailFeedGlobal.length > 0){
      		var url = "https://mail.google.com/mail/u/0/#inbox/" + (emailFeedGlobal[emailNum].id);
      		window.open(url);
      		return url;
      	}
      	else
      	{
      		window.open("https://mail.google.com/mail/u/0/#inbox");
      		return "https://mail.google.com/mail/u/0/#inbox";
      	}
    }
		      
	/**
		* Parses the email message, decoding from 64 to prevent  
		* garbage characters from being shown.
		* 
		* @param {resp2} an array of email content supplied by the google API
		* @return {revisedMessage} 64 decoded email message.
	*/ 
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
		      

	/**
		* Main function for creating the email message widget.  Provided a  
		* emailFeed array, this function modifies the DOM to display the messages 
		* in a formatted way to the user. 
		*
		* @param {emailFeed} an array of email content supplied by the google API
		* @return {emailNum} the number of emails to display. 
	*/  
	function createMessage(emailFeed, emailNum) {
			
		btn.onclick = function() { 
			gapi.client.gmail.users.messages.delete({
			'userId': 'me',
			'id' : temp
			}).execute(function(resp) { location.reload(); }); 
		};        	
		    	
		$(window).trigger('resize');

        if(emailFeed.length > 0) {
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
			else {
				document.getElementById("emailBody").innerHTML = "you don't have any messages";
			}    	       	
  	}

	/**
		* Retreives the next message in a user's email box, either directly before 
		* or directly after the date of the current message. 
		*
		* @param {direction} either 'left' or 'right', left for new messages, right for older messages.
		* @return {none}
	*/    	
  	function nextMessage(direction) {
  		if (direction == 'right') {
  			if (emailNum < emailFeedGlobal.length-1) {
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
