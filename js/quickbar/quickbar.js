
var editingQuickbar = false
var blinkInterval;

function editQuickbar () {
	
	//if we are editing, stop editing
	if (editingQuickbar) {
		
		//stop the blinking animation
		clearInterval(blinkInterval);
		
		//turn editing indictor off
		$("#edit-qb-item").removeClass("active");
		
		//for each quickbar item
		$("#quickbar-list .quickbar-item").each(function () {
			
			//remove blinking classes
			$(this).removeClass("blinkDown");
			$(this).removeClass("blinkUp");
		});
		
		//disable sorting
		$("#quickbar-list").sortable("disable");
		
		//turn off the remove buttons
		$("#quickbar-list .quickbarItemRemoveButton").each(function () {
			$(this).hide();	
		});
		
	}
	
	//otherwise, start editing
	else {
		
		//turn editing indictor on
		$("#edit-qb-item").addClass("active");
		
		//enable sorting
		$("#quickbar-list").sortable({
			containment: "parent",
			stop: saveQuickbarChanges
		});
		$("#quickbar-list").sortable("enable");
		
		//turn on the remove buttons
		$("#quickbar-list .quickbarItemRemoveButton").each(function () {
			$(this).show();	
		});
		
		//declare function to blink the items
		var blinkQuickbar = function () {
			$("#quickbar-list .quickbar-item").each(function () {
				if ($(this).hasClass("blinkUp")) {
					$(this).removeClass("blinkUp");
					$(this).addClass("blinkDown");
				}
				else {
					$(this).addClass("blinkUp");
					$(this).removeClass("blinkDown");
				}
			});
		}
		
		//blink the items
		blinkQuickbar();
		blinkInterval = setInterval(blinkQuickbar, 500);
			
		
	}
	
	//switch the editingQuickbar flag
	editingQuickbar = !editingQuickbar;
}


//removes the li from the DOM
function removeQuickbarItem(element) {
	$(element).parent().remove();
	
	//save the changes
	saveQuickbarChanges();
}


function saveQuickbarChanges() {
	
	//create a structure to be passed to the back end code
	var quickbarLinks = {}
	$("#quickbar-list .quickbar-item a").each(function (index) {
		
		var link = $(this).attr("href");
		
		quickbarLinks["link" + index] = link;
	});
	
	//send this array somewhere to be put in the db
	$.post( "/php/controllers/editQuickbar.php", quickbarLinks);
}























