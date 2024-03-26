$(document).ready(function () {


  function newitem(id, text, state, important) {
    let statestyle = {
      todo: "",
      progress: "",
      completed: "opacity-60%",
    };

    let satteButton = {
      todo: "Add to Progress",
      progress: "Add to Completed",
      completed: "Back to Completed",
    };

    let item = `
	<div class="item ${statestyle[state]}" id="${id}">
	<i class="fa-${state === "todo" ? "regular" : "solid"} fa-circle-check"></i>
	<input type="text" value="${text}"  readonly class="form-control updating item-content ${
      state === "completed" && "text-decoration-line-through"
    }">

	<i class="fa-${(important == 1 ? "solid" : "regular")} fa-star"></i>

	<div class="dropdown open">
		<button
			class="btn dropdown-toggle"
			type="button"
			id="triggerId"
			data-bs-toggle="dropdown"
			aria-haspopup="true"
			aria-expanded="false"
		>
		<i class="fa-solid fa-ellipsis"></i>
		</button>
		<div class="dropdown-menu" aria-labelledby="triggerId">
			<button class="dropdown-item" href="#">Edit task</button>
			<button class="dropdown-item" href="#">${satteButton[state]}</button>
			<button class="dropdown-item" href="#">Remove Impotence</button>
			<button class="dropdown-item text-danger delete-btn" data-id="${id}">Delete item </button>
		</div>
	</div>
</div>
`;

    return item;
  }

  $(".submitbtn").click(function (event) {
    event.preventDefault(); // Prevent default form submission behavior
  
    let value = $(".adder").val().trim();
  
    if (value) {
      addNewItem(value);
      $(".adder").val(""); // Clear the input field
    } 
  });
  
  function addNewItem(value, state = "todo", important = 0) {
    $.ajax({
      url: "ajax/additem.php", 
      type: "POST",
      data: {
        "text": value,
        "state": state,
        "important": important
      },
      success: function(response) {
        // Handle successful insertion (e.g., update UI, display a success message)
        let data = JSON.parse(response)
        console.log("Item added successfully:", data); // For logging (optional)
        addItemToAppropriateDive(data.id, value, state, important)
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors (e.g., display an error message, log details)
        console.error("Error adding item:", textStatus, errorThrown);
      }
    });
  }  


  $(document).on('click', '.delete-btn', function () {
    let id = $(this).data("id");
  
    $.ajax({
      url: "ajax/deleteitem.php",
      type: "POST",
      data: {
        "id": id
      },
      success: function(response) {
          // Successful deletion - remove item from DOM
          $(`#${id}`).fadeOut(function() {
            $(this).remove(); // Remove the element after fade-out
            console.log("Item deleted successfully:", response); 
            console.log("this item:", $(this)); 
          });
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle general AJAX request errors
        console.error("AJAX Error:", textStatus, errorThrown);
        alert("An error occurred while deleting the item. Please try again."); // User-friendly alert
      }
    });
  });
  
  



  // for inserting data to the document  when first user comes to the website 
  todos.forEach((todo) => {
    addItemToAppropriateDive(todo[0], todo[1], todo[2], todo[3]);
  });
  
  
    $(".item-content.updating").click(function () {
      if (!$(this).closest(".item").hasClass("opacity-50")) {
        $(this).prop("readonly", !$(this).prop("readonly")); // Toggle readonly attribute directly
      }
    });

      
  function addItemToAppropriateDive(id, text, state, important) {

    let item = newitem(id, text, state, important);

    switch (state) {
      case "todo":
        (important == 0) ?  $(".todo").append(item) : $(".todo .card-heading").after(item);
        break;
      case "progress":
        (important == 0) ?  $(".doing").append(item) : $(".doing .card-heading").after(item);
        break;
      case "completed":
        (important == 0) ?  $(".completed").append(item) : $(".completed .card-heading").after(item);
        break;
      default:
        console.warn("Invalid state:", state); // Handle unexpected state values gracefully
        break;
    }
  }


  $('.item').sortable({
    connectWith: ".doing",
    cursor: "grab"
  })
  


});
