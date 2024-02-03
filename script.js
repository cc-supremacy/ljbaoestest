let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

function showSubjects(){

  var x = document.getElementById("year").value;
  $.ajax({
      url:"student/showSubjects.php",
      method: "POST",
      data:{
          id : x
      },
      success:function(data){
          $("#ans").html(data);
      }
  })
  }

 
  $(document).ready(function() {
// Event listener for subCode input change
$('#subCode').change(function() {
  console.log('Change event triggered');
  // Get selected subCode
  var selectedSubCode = $(this).val();
  console.log('Selected subCode:', selectedSubCode);

  // Make AJAX request to fetch subName based on selected subCode
  $.ajax({
      url: 'fetch_subname.php',
      type: 'POST',
      data: { subCode: selectedSubCode },
      dataType: 'json',
      success: function(data) {
          console.log('Data received:', data);

          // Check if 'subName' property exists in the response
          if (data && data.subName) {
              // Populate subName input with fetched data
              $('#subName').val(data.subName);
          } else {
              console.error('Missing or invalid subName property in the response:', data);
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching subName:', status, error);
      }
  });
});
});

  

$(document).ready(function() {
  // Event listener for subCode input change
  $('#subCode').change(function() {
      console.log('Change event triggered');
      // Get selected subCode
      var selectedSubCode = $(this).val();
      console.log('Selected subCode:', selectedSubCode);

      // Make AJAX request to fetch subName based on selected subCode
      $.getJSON('fetch_subname.php', { subCode: selectedSubCode }, function(data) {
          console.log('Data received:', data);

          // Check if 'subName' property exists in the response
          if (data && data.subName) {
              // Populate subName input with fetched data
              $('#subName').val(data.subName);
          } else {
              console.error('Missing or invalid subName property in the response:', data);
          }
      });
  });
});

