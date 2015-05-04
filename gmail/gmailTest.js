QUnit.test( "ParseMessage13", function( assert ) {

	
JsHamcrest.Integration.QUnit();
JsMockito.Integration.QUnit();

var exampleJson = {"id":"14ced9596827faff","threadId":"14c97a449b9f2d29","labelIds":["INBOX","CATEGORY_PERSONAL","UNREAD"],"snippet":"Instructor (Fred Douglas) posted a response to the followup &quot; do we need to do extra stuff if we","historyId":"554695","payload":{"mimeType":"multipart/alternative","filename":"","headers":[{"name":"Delivered-To","value":"hianant2@g.illinois.edu"},{"name":"Received","value":"by 10.25.80.4 with SMTP id e4csp96124lfb;        Fri, 24 Apr 2015 15:39:06 -0700 (PDT)"},{"name":"X-Received","value":"by 10.50.79.202 with SMTP id l10mr277728igx.7.1429915145880;        Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"},{"name":"Return-Path","value":"<bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com>"},{"name":"Received","value":"from pps04.cites.illinois.edu (pps04.cites.illinois.edu. [192.17.82.101])        by mx.google.com with ESMTPS id qa6si10748176icb.82.2015.04.24.15.39.05        for <hianant2@g.illinois.edu>        (version=TLSv1 cipher=RC4-SHA bits=128/128);        Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"},{"name":"Received-SPF","value":"pass (google.com: domain of bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com designates 75.126.253.244 as permitted sender) client-ip=75.126.253.244;"},{"name":"Authentication-Results","value":"mx.google.com;       spf=pass (google.com: domain of bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com designates 75.126.253.244 as permitted sender) smtp.mail=bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com;       dkim=pass header.i=@sendgrid.piazza.com"},{"name":"Received","value":"from o1.sendgrid.piazza.com (o1.sendgrid.piazza.com [75.126.253.244]) by pps04.cites.illinois.edu (8.14.5/8.14.5) with ESMTP id t3OMd3EW001589 (version=TLSv1/SSLv3 cipher=DHE-RSA-AES128-SHA bits=128 verify=NOT) for <hianant2@illinois.edu>; Fri, 24 Apr 2015 17:39:04 -0500"},{"name":"DKIM-Signature","value":"v=1; a=rsa-sha1; c=relaxed; d=sendgrid.piazza.com; h=from:to:in-reply-to:references:subject:mime-version:content-type; s=smtpapi; bh=3loGUEOUGo5vS/Iv4veGDob52Pc=; b=uro4CUsgJqoEnkciLt Qm39WFPdkuRyrInCxcGhfUPu2xqjB21rmwBEAYH+bcnKB4Y5wZrzee1n1YZfhcE1 Kxvue3gF0O5+YZLhB7ppcT0hZdEvwVc01SRHULdcdiVNNNtRjnSSicQhxrXeOI8y HZiHT3bRA2lgHOOzUP2W5+elQ="},{"name":"DomainKey-Signature","value":"a=rsa-sha1; c=nofws; d=piazza.com; h=from:to:in-reply-to:references:subject:mime-version:content-type; q=dns; s=smtpapi; b=MNYQItSk+5cURXeHEF/Zq/cQKIRsL9Jz+PmanPRUt46n 9JIZsLB/PnAQA0H6quFDSRZ84C49ldhIx499+TSoP4hYdmjEtGIA7KRY6hteZc8b 1y8GEaQxih3im160Y/67FEfJfFMQyUbXMT+djPJYltuonocFxSspfSDWSDMjhKc="},{"name":"Received","value":"by filter0438p1mdw1.sendgrid.net with SMTP id filter0438p1mdw1.17443.553AC605F        2015-04-24 22:39:01.915699555 +0000 UTC"},{"name":"Received","value":"from smtp.sendgrid.net (ec2-107-20-25-117.compute-1.amazonaws.com [107.20.25.117]) by ismtpd-049 (SG) with ESMTP id 14ced958675.6f76.321fb0 for <hianant2@illinois.edu>; Fri, 24 Apr 2015 22:39:01 +0000 (UTC)"},{"name":"Date","value":"Fri, 24 Apr 2015 22:39:01 +0000 (UTC)"},{"name":"From","value":"CS 438 on Piazza <no-reply@piazza.com>"},{"name":"To","value":"hianant2@illinois.edu"},{"name":"Message-ID","value":"<i8w6k052i8x595_0@piazza.com>"},{"name":"In-Reply-To","value":"<i88c3fqopld4vq@piazza.com>"},{"name":"References","value":"<i88c3fqopld4vq@piazza.com>"},{"name":"Subject","value":"[Instr Note] MP3 posted"},{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"multipart/alternative; boundary=\"----=_Part_51670_1687598036.1429915141702\""},{"name":"X-SG-EID","value":"PDgarT0WJZajUMbAAvacd5PcvJMbRw9PZxj+hYXJus38D2vvkfoVDz92LQP9kvA2mFEXG057evXdqp wW+GQJ+lPHgGKP+gkP8IxVQp9zaiLMxO6MG+MqMJN2Fzj0PY1+yAY+NWv9/BBLZ+1w86LaW9dpZONr TgGL7WkDsPs3358="},{"name":"X-Spam-Score","value":"0"},{"name":"X-Spam-Details","value":"rule=cautious_plus_nq_notspam policy=cautious_plus_nq score=0 spamscore=0 suspectscore=3 phishscore=0 adultscore=0 bulkscore=0 classifier=spam adjust=0 reason=mlx scancount=1 engine=7.0.1-1402240000 definitions=main-1504240279"},{"name":"X-Spam-OrigSender","value":"bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com"},{"name":"X-Spam-Bar","value":""}],"body":{"size":0},"parts":[{"partId":"0","mimeType":"text/plain","filename":"","headers":[{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"text/plain; charset=UTF-8"},{"name":"Content-Transfer-Encoding","value":"7bit"}],"body":{"size":664,"data":"SW5zdHJ1Y3RvciAoRnJlZCBEb3VnbGFzKSBwb3N0ZWQgYSByZXNwb25zZSB0byB0aGUgZm9sbG93dXAgIjxwPmRvIHdlIG5lZWQgdG8gZG8gZXh0cmEgc3R1ZmYgaWYgd2Ugd29yayBvbiBwYWlycz88L3A-IDxwPjwvcD4gPHA-VGhhbmsgeW91IGluIGFkdmFuY2U8L3A-IjoNCg0KTm8uDQoNCkdvIHRvIGh0dHA6Ly9waWF6emEuY29tL2NsYXNzP2NpZD1pODhjM2Zxb3BsZDR2cSZuaWQ9aTU1aDY4OHZudG40Z3QmdG9rZW49RUJMa1dmamRxZFMgdG8gdmlldyBkZXRhaWxzLiBTZWFyY2ggb3IgbGluayB0byB0aGlzIHF1ZXN0aW9uIHdpdGggQDY0NS4gDQoNCkFuZCBpZiB5b3UncmUgbG9va2luZyBmb3IgYSBqb2Igb3IgaW50ZXJuc2hpcCwgY2hlY2sgb3V0IFBpYXp6YSBDYXJlZXJzIC0gdGhlIG5leHQgcGhhc2UgaW4gUGlhenphJ3Mgam91cm5leS4NCg0KVGhhbmtzLA0KVGhlIFBpYXp6YSBUZWFtDQotLQ0KQ29udGFjdCB1cyBhdCB0ZWFtQHBpYXp6YS5jb20NCg0KWW91J3JlIGN1cnJlbnRseSBmb2xsb3dpbmcgdGhpcyBwb3N0IGJlY2F1c2UgeW91IGVpdGhlciBwYXJ0aWNpcGF0ZWQgaW4gaXQsIG9yIGNob3NlIHRvIGZvbGxvdyBpdC4gVG8gbm8gbG9uZ2VyIHJlY2VpdmUgZW1haWxzIGFib3V0IHRoaXMgcG9zdCwgeW91IGNhbiBzdG9wIGZvbGxvd2luZyBpdC4NCg=="}},{"partId":"1","mimeType":"text/html","filename":"","headers":[{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"text/html; charset=UTF-8"},{"name":"Content-Transfer-Encoding","value":"7bit"}],"body":{"size":786,"data":"PGh0bWw-DQpJbnN0cnVjdG9yIChGcmVkIERvdWdsYXMpIHBvc3RlZCBhIHJlc3BvbnNlIHRvIHRoZSBmb2xsb3d1cCAiPHA-ZG8gd2UgbmVlZCB0byBkbyBleHRyYSBzdHVmZiBpZiB3ZSB3b3JrIG9uIHBhaXJzPzwvcD4gPHA-PC9wPiA8cD5UaGFuayB5b3UgaW4gYWR2YW5jZTwvcD4iOjxicj4NCjxicj4NCjxwPk5vLjwvcD48YnI-DQo8YnI-DQo8YSBocmVmPSJodHRwOi8vcGlhenphLmNvbS9jbGFzcz9jaWQ9aTg4YzNmcW9wbGQ0dnEmbmlkPWk1NWg2ODh2bnRuNGd0JnRva2VuPUVCTGtXZmpkcWRTIj5DbGljayBoZXJlPC9hPiB0byB2aWV3IGRldGFpbHMuIFNlYXJjaCBvciBsaW5rIHRvIHRoaXMgcXVlc3Rpb24gd2l0aCBANjQ1LiA8YnI-PGJyPg0KQW5kIGlmIHlvdSdyZSBsb29raW5nIGZvciBhIGpvYiBvciBpbnRlcm5zaGlwLCBjaGVjayBvdXQgUGlhenphIENhcmVlcnMgLSB0aGUgbmV4dCBwaGFzZSBpbiBQaWF6emEncyBqb3VybmV5Ljxicj48YnI-DQo8YnI-DQpUaGFua3MsPGJyPg0KVGhlIFBpYXp6YSBUZWFtPGJyPg0KLS08YnI-DQpDb250YWN0IHVzIGF0IHRlYW1AcGlhenphLmNvbTxicj48YnI-DQo8Zm9udCBzaXplPSItMiI-WW91J3JlIGN1cnJlbnRseSBmb2xsb3dpbmcgdGhpcyBwb3N0IGJlY2F1c2UgeW91IGVpdGhlciBwYXJ0aWNpcGF0ZWQgaW4gaXQsIG9yIGNob3NlIHRvIGZvbGxvdyBpdC4gVG8gbm8gbG9uZ2VyIHJlY2VpdmUgZW1haWxzIGFib3V0IHRoaXMgcG9zdCwgeW91IGNhbiBzdG9wIGZvbGxvd2luZyBpdC48L2ZvbnQ-PGJyPg0KPC9odG1sPg0K"}}]},"sizeEstimate":5198,"result":{"id":"14ced9596827faff","threadId":"14c97a449b9f2d29","labelIds":["INBOX","CATEGORY_PERSONAL","UNREAD"],"snippet":"Instructor (Fred Douglas) posted a response to the followup &quot; do we need to do extra stuff if we","historyId":"554695","payload":{"mimeType":"multipart/alternative","filename":"","headers":[{"name":"Delivered-To","value":"hianant2@g.illinois.edu"},{"name":"Received","value":"by 10.25.80.4 with SMTP id e4csp96124lfb;        Fri, 24 Apr 2015 15:39:06 -0700 (PDT)"},{"name":"X-Received","value":"by 10.50.79.202 with SMTP id l10mr277728igx.7.1429915145880;        Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"},{"name":"Return-Path","value":"<bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com>"},{"name":"Received","value":"from pps04.cites.illinois.edu (pps04.cites.illinois.edu. [192.17.82.101])        by mx.google.com with ESMTPS id qa6si10748176icb.82.2015.04.24.15.39.05        for <hianant2@g.illinois.edu>        (version=TLSv1 cipher=RC4-SHA bits=128/128);        Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"},{"name":"Received-SPF","value":"pass (google.com: domain of bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com designates 75.126.253.244 as permitted sender) client-ip=75.126.253.244;"},{"name":"Authentication-Results","value":"mx.google.com;       spf=pass (google.com: domain of bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com designates 75.126.253.244 as permitted sender) smtp.mail=bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com;       dkim=pass header.i=@sendgrid.piazza.com"},{"name":"Received","value":"from o1.sendgrid.piazza.com (o1.sendgrid.piazza.com [75.126.253.244]) by pps04.cites.illinois.edu (8.14.5/8.14.5) with ESMTP id t3OMd3EW001589 (version=TLSv1/SSLv3 cipher=DHE-RSA-AES128-SHA bits=128 verify=NOT) for <hianant2@illinois.edu>; Fri, 24 Apr 2015 17:39:04 -0500"},{"name":"DKIM-Signature","value":"v=1; a=rsa-sha1; c=relaxed; d=sendgrid.piazza.com; h=from:to:in-reply-to:references:subject:mime-version:content-type; s=smtpapi; bh=3loGUEOUGo5vS/Iv4veGDob52Pc=; b=uro4CUsgJqoEnkciLt Qm39WFPdkuRyrInCxcGhfUPu2xqjB21rmwBEAYH+bcnKB4Y5wZrzee1n1YZfhcE1 Kxvue3gF0O5+YZLhB7ppcT0hZdEvwVc01SRHULdcdiVNNNtRjnSSicQhxrXeOI8y HZiHT3bRA2lgHOOzUP2W5+elQ="},{"name":"DomainKey-Signature","value":"a=rsa-sha1; c=nofws; d=piazza.com; h=from:to:in-reply-to:references:subject:mime-version:content-type; q=dns; s=smtpapi; b=MNYQItSk+5cURXeHEF/Zq/cQKIRsL9Jz+PmanPRUt46n 9JIZsLB/PnAQA0H6quFDSRZ84C49ldhIx499+TSoP4hYdmjEtGIA7KRY6hteZc8b 1y8GEaQxih3im160Y/67FEfJfFMQyUbXMT+djPJYltuonocFxSspfSDWSDMjhKc="},{"name":"Received","value":"by filter0438p1mdw1.sendgrid.net with SMTP id filter0438p1mdw1.17443.553AC605F        2015-04-24 22:39:01.915699555 +0000 UTC"},{"name":"Received","value":"from smtp.sendgrid.net (ec2-107-20-25-117.compute-1.amazonaws.com [107.20.25.117]) by ismtpd-049 (SG) with ESMTP id 14ced958675.6f76.321fb0 for <hianant2@illinois.edu>; Fri, 24 Apr 2015 22:39:01 +0000 (UTC)"},{"name":"Date","value":"Fri, 24 Apr 2015 22:39:01 +0000 (UTC)"},{"name":"From","value":"CS 438 on Piazza <no-reply@piazza.com>"},{"name":"To","value":"hianant2@illinois.edu"},{"name":"Message-ID","value":"<i8w6k052i8x595_0@piazza.com>"},{"name":"In-Reply-To","value":"<i88c3fqopld4vq@piazza.com>"},{"name":"References","value":"<i88c3fqopld4vq@piazza.com>"},{"name":"Subject","value":"[Instr Note] MP3 posted"},{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"multipart/alternative; boundary=\"----=_Part_51670_1687598036.1429915141702\""},{"name":"X-SG-EID","value":"PDgarT0WJZajUMbAAvacd5PcvJMbRw9PZxj+hYXJus38D2vvkfoVDz92LQP9kvA2mFEXG057evXdqp wW+GQJ+lPHgGKP+gkP8IxVQp9zaiLMxO6MG+MqMJN2Fzj0PY1+yAY+NWv9/BBLZ+1w86LaW9dpZONr TgGL7WkDsPs3358="},{"name":"X-Spam-Score","value":"0"},{"name":"X-Spam-Details","value":"rule=cautious_plus_nq_notspam policy=cautious_plus_nq score=0 spamscore=0 suspectscore=3 phishscore=0 adultscore=0 bulkscore=0 classifier=spam adjust=0 reason=mlx scancount=1 engine=7.0.1-1402240000 definitions=main-1504240279"},{"name":"X-Spam-OrigSender","value":"bounces+5126-611a-hianant2=illinois.edu@sendgrid.piazza.com"},{"name":"X-Spam-Bar","value":""}],"body":{"size":0},"parts":[{"partId":"0","mimeType":"text/plain","filename":"","headers":[{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"text/plain; charset=UTF-8"},{"name":"Content-Transfer-Encoding","value":"7bit"}],"body":{"size":664,"data":"SW5zdHJ1Y3RvciAoRnJlZCBEb3VnbGFzKSBwb3N0ZWQgYSByZXNwb25zZSB0byB0aGUgZm9sbG93dXAgIjxwPmRvIHdlIG5lZWQgdG8gZG8gZXh0cmEgc3R1ZmYgaWYgd2Ugd29yayBvbiBwYWlycz88L3A-IDxwPjwvcD4gPHA-VGhhbmsgeW91IGluIGFkdmFuY2U8L3A-IjoNCg0KTm8uDQoNCkdvIHRvIGh0dHA6Ly9waWF6emEuY29tL2NsYXNzP2NpZD1pODhjM2Zxb3BsZDR2cSZuaWQ9aTU1aDY4OHZudG40Z3QmdG9rZW49RUJMa1dmamRxZFMgdG8gdmlldyBkZXRhaWxzLiBTZWFyY2ggb3IgbGluayB0byB0aGlzIHF1ZXN0aW9uIHdpdGggQDY0NS4gDQoNCkFuZCBpZiB5b3UncmUgbG9va2luZyBmb3IgYSBqb2Igb3IgaW50ZXJuc2hpcCwgY2hlY2sgb3V0IFBpYXp6YSBDYXJlZXJzIC0gdGhlIG5leHQgcGhhc2UgaW4gUGlhenphJ3Mgam91cm5leS4NCg0KVGhhbmtzLA0KVGhlIFBpYXp6YSBUZWFtDQotLQ0KQ29udGFjdCB1cyBhdCB0ZWFtQHBpYXp6YS5jb20NCg0KWW91J3JlIGN1cnJlbnRseSBmb2xsb3dpbmcgdGhpcyBwb3N0IGJlY2F1c2UgeW91IGVpdGhlciBwYXJ0aWNpcGF0ZWQgaW4gaXQsIG9yIGNob3NlIHRvIGZvbGxvdyBpdC4gVG8gbm8gbG9uZ2VyIHJlY2VpdmUgZW1haWxzIGFib3V0IHRoaXMgcG9zdCwgeW91IGNhbiBzdG9wIGZvbGxvd2luZyBpdC4NCg=="}},{"partId":"1","mimeType":"text/html","filename":"","headers":[{"name":"MIME-Version","value":"1.0"},{"name":"Content-Type","value":"text/html; charset=UTF-8"},{"name":"Content-Transfer-Encoding","value":"7bit"}],"body":{"size":786,"data":"PGh0bWw-DQpJbnN0cnVjdG9yIChGcmVkIERvdWdsYXMpIHBvc3RlZCBhIHJlc3BvbnNlIHRvIHRoZSBmb2xsb3d1cCAiPHA-ZG8gd2UgbmVlZCB0byBkbyBleHRyYSBzdHVmZiBpZiB3ZSB3b3JrIG9uIHBhaXJzPzwvcD4gPHA-PC9wPiA8cD5UaGFuayB5b3UgaW4gYWR2YW5jZTwvcD4iOjxicj4NCjxicj4NCjxwPk5vLjwvcD48YnI-DQo8YnI-DQo8YSBocmVmPSJodHRwOi8vcGlhenphLmNvbS9jbGFzcz9jaWQ9aTg4YzNmcW9wbGQ0dnEmbmlkPWk1NWg2ODh2bnRuNGd0JnRva2VuPUVCTGtXZmpkcWRTIj5DbGljayBoZXJlPC9hPiB0byB2aWV3IGRldGFpbHMuIFNlYXJjaCBvciBsaW5rIHRvIHRoaXMgcXVlc3Rpb24gd2l0aCBANjQ1LiA8YnI-PGJyPg0KQW5kIGlmIHlvdSdyZSBsb29raW5nIGZvciBhIGpvYiBvciBpbnRlcm5zaGlwLCBjaGVjayBvdXQgUGlhenphIENhcmVlcnMgLSB0aGUgbmV4dCBwaGFzZSBpbiBQaWF6emEncyBqb3VybmV5Ljxicj48YnI-DQo8YnI-DQpUaGFua3MsPGJyPg0KVGhlIFBpYXp6YSBUZWFtPGJyPg0KLS08YnI-DQpDb250YWN0IHVzIGF0IHRlYW1AcGlhenphLmNvbTxicj48YnI-DQo8Zm9udCBzaXplPSItMiI-WW91J3JlIGN1cnJlbnRseSBmb2xsb3dpbmcgdGhpcyBwb3N0IGJlY2F1c2UgeW91IGVpdGhlciBwYXJ0aWNpcGF0ZWQgaW4gaXQsIG9yIGNob3NlIHRvIGZvbGxvdyBpdC4gVG8gbm8gbG9uZ2VyIHJlY2VpdmUgZW1haWxzIGFib3V0IHRoaXMgcG9zdCwgeW91IGNhbiBzdG9wIGZvbGxvd2luZyBpdC48L2ZvbnQ-PGJyPg0KPC9odG1sPg0K"}}]},"sizeEstimate":5198}};
var result = parseJsonType13(exampleJson);
	var body = "SW5zdHJ1Y3RvciAoRnJlZCBEb3VnbGFzKSBwb3N0ZWQgYSByZXNwb25zZSB0byB0aGUgZm9sbG93dXAgIjxwPmRvIHdlIG5lZWQgdG8gZG8gZXh0cmEgc3R1ZmYgaWYgd2Ugd29yayBvbiBwYWlycz88L3A-IDxwPjwvcD4gPHA-VGhhbmsgeW91IGluIGFkdmFuY2U8L3A-IjoNCg0KTm8uDQoNCkdvIHRvIGh0dHA6Ly9waWF6emEuY29tL2NsYXNzP2NpZD1pODhjM2Zxb3BsZDR2cSZuaWQ9aTU1aDY4OHZudG40Z3QmdG9rZW49RUJMa1dmamRxZFMgdG8gdmlldyBkZXRhaWxzLiBTZWFyY2ggb3IgbGluayB0byB0aGlzIHF1ZXN0aW9uIHdpdGggQDY0NS4gDQoNCkFuZCBpZiB5b3UncmUgbG9va2luZyBmb3IgYSBqb2Igb3IgaW50ZXJuc2hpcCwgY2hlY2sgb3V0IFBpYXp6YSBDYXJlZXJzIC0gdGhlIG5leHQgcGhhc2UgaW4gUGlhenphJ3Mgam91cm5leS4NCg0KVGhhbmtzLA0KVGhlIFBpYXp6YSBUZWFtDQotLQ0KQ29udGFjdCB1cyBhdCB0ZWFtQHBpYXp6YS5jb20NCg0KWW91J3JlIGN1cnJlbnRseSBmb2xsb3dpbmcgdGhpcyBwb3N0IGJlY2F1c2UgeW91IGVpdGhlciBwYXJ0aWNpcGF0ZWQgaW4gaXQsIG9yIGNob3NlIHRvIGZvbGxvdyBpdC4gVG8gbm8gbG9uZ2VyIHJlY2VpdmUgZW1haWxzIGFib3V0IHRoaXMgcG9zdCwgeW91IGNhbiBzdG9wIGZvbGxvd2luZyBpdC4NCg==";
	body = decode64(body);

    assert.ok( result.snippet == "Instructor (Fred Douglas) posted a response to the followup &quot; do we need to do extra stuff if we", "Passed! check snippet " );
    assert.ok( result.title == "[Instr Note] MP3 posted", "Passed! check title " );
    assert.ok( result.body == body, "Passed! check body " );
    assert.ok( result.from == "CS 438 on Piazza <no-reply@piazza.com>", "Passed! check from " );
    assert.ok( result.id == "14ced9596827faff", "Passed! check id " );


});

QUnit.test( "CreateMessageEmpty", function( assert ) {

	
	var emailFeeds = [];
	var emailNums = 0;
	createMessage(emailFeeds, emailNums);
    assert.ok( document.getElementById("emailBody").innerHTML == "you don't have any messages", "Passed! inbox is empty" );

});



QUnit.test( "CreateMessage1", function( assert ) {
	var emailObject = {
		'body' : "body",
		'from' : "from",
		'snippet' : "snippet",
		'date' : new Date("Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"),
		'title' : "title",									
		'id' : "temp"
	};
	
	var emailFeeds = [];
	emailFeeds.push(emailObject);
	var emailNums = 0;
	createMessage(emailFeeds, emailNums);
	var date = emailObject.date;
	date = JSON.stringify(date);
	date = date.substring(1, 11);
	var expectedResult = JSON.stringify(emailObject.title) +" "+"("+ date +")";
    assert.ok( document.getElementById("emailTitle").innerHTML == expectedResult, "Passed! email title is set correctly");
    assert.ok( document.getElementById("emailBody").innerHTML == "body", "Passed! email body is set correctly" );

});



QUnit.test( "processData", function( assert ) {
	var emailFeed = [];
	var emailObject = {
		'body' : "body",
		'from' : "from",
		'snippet' : "snippet",
		'date' : new Date("Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"),
		'title' : "title",									
		'id' : "temp"
	};
	
	var emailObject2 = {
		'body' : "body2",
		'from' : "from2",
		'snippet' : "snippet2",
		'date' : new Date("Fri, 25 Apr 2015 15:39:05 -0700 (PDT)"),
		'title' : "title2",									
		'id' : "temp2"
	};
	emailFeed.push(emailObject);
	emailFeed.push(emailObject2);
	processData(emailFeed);
	var date0 = emailFeed[0].date;
	var date1 = emailFeed[1].date;
	assert.ok(date0-date1 > 0 ,"Passed sorting array");

});




QUnit.test( "DirectionTest", function( assert ) {
	var emailFeed = [];
	var emailObject = {
		'body' : "body",
		'from' : "from",
		'snippet' : "snippet",
		'date' : new Date("Fri, 24 Apr 2015 15:39:05 -0700 (PDT)"),
		'title' : "title",									
		'id' : "temp"
	};
	
	var emailObject2 = {
		'body' : "body2",
		'from' : "from2",
		'snippet' : "snippet2",
		'date' : new Date("Fri, 25 Apr 2015 15:39:05 -0700 (PDT)"),
		'title' : "title2",									
		'id' : "temp2"
	};
	emailFeed.push(emailObject);
	emailFeed.push(emailObject2);
	processData(emailFeed);
	assert.ok( document.getElementById("emailBody").innerHTML == "body2", "Passed! initial email body is set correctly" );
	nextMessage('right');
	assert.ok( document.getElementById("emailBody").innerHTML == "body", "Passed! right button older message works correctly" );
	nextMessage('right');
	assert.ok( document.getElementById("emailBody").innerHTML == "body", "Passed! right button boundary works correctly" );

	nextMessage('left');
	assert.ok( document.getElementById("emailBody").innerHTML == "body2", "Passed! left button newer message works correctly" );
	nextMessage('left');
	assert.ok( document.getElementById("emailBody").innerHTML == "body2", "Passed! left button boundary works correctly" );

});









QUnit.test( "Testdecode64", function( assert ) {

var origString = "hello";
var string = btoa(origString);
var result = decode64(string);

assert.ok(result == origString, "Pass decode64");

});


