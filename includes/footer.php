<footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
<div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
      /* document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
      }); */


      $(document).ready(function(){
        $('.modal').modal();
      });

/* $(".delete_btn").on('click', function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = link;
        }
      });
    }); */

      $(document).on('click', '.edit_data', function(){
           var id = $(this).attr("id");
           $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{id:id},
                dataType:"json",
                success:function(data){
                     $('#title').val(data.title);
                     $('#body').val(data.body);
                     $('#id').val(data.id);
                }
           });
      });
      $('#update_form').on("submit", function(event){
           event.preventDefault();
           if($('#title').val() == "")
           {
                alert("Title is required");
           }
           else if($('#boty').val() == '')
           {
                alert("Text is required");
           }
           else
           {
                $.ajax({
                     url:"update.php",
                     method:"POST",
                     data:$('#update_form').serialize(),
                     beforeSend:function(){
                          $('#insert').val("Updating");
                     },
                     success:function(data){
                          $('#update_form')[0].reset();
                          $('#modal1').modal('close');
                         // $('#post_table').html(data);
                         location.reload();
                     }
                });
           }
      });

      $('.dropdown-trigger').dropdown();
    </script>

  </body>
</html>
