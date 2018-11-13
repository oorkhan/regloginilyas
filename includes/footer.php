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

      $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
      });


      function add_comment(pid){
        //console.log(pid,$("#comment_to_"+pid).val());
        $.ajax({
          url : "addcomment.php",
          method : "POST",
            data : {pid : pid, text : $("#comment_to_"+pid).val()},
          success : function(data){
            if(data!=="empty"){
              $("#comment_to_"+pid).val("");
              var comment = JSON.parse(data);
              $("#comments_of_"+pid).prepend(`<li>${comment.username} :  ${comment.text}</li>`)
            }
          },
          error : function(e){
            console.log(e);
          }
        });
      }


      function like(pid){
        $.ajax({
          url : "likepost.php",
          method : "POST",
          data : {pid : pid},
          success : function(data){
            console.log(data);
            $("#likes_of_"+pid).text(data);
            var btn =  $("button[data-id='"+pid+"']");
            btn.attr("onclick" , `unlike(${pid})`);
            btn.html('<i class="material-icons">thumb_down</i>');
            btn.removeClass("orange");
            btn.addClass("red")
          },
          error : function(e){
            console.log(e);
          }
        });
      }


      function unlike(pid){
        $.ajax({
          url : "unlikepost.php",
          method : "POST",
          data : {pid : pid},
          success : function(data){
            console.log(data);
            $("#likes_of_"+pid).text(data);
            var btn =  $("button[data-id='"+pid+"']");
            btn.attr("onclick" , `like(${pid})`);
            btn.html('<i class="material-icons">thumb_up</i>');
            btn.removeClass("red");
            btn.addClass("orange")
          },
          error : function(e){
            console.log(e);
          }
        });
      }


      window.no_more_posts = false;
      var X = true;

      $(window).scroll(function(){
        console.log("...");
         if(($(window).scrollTop() == ($(document).height() - $(window).height())) && X === true && window.no_more_posts === false && typeof index_page !== 'undefined'){
           X = false;
           $("#loading").show();
           $("html, body").animate({ scrollBottom: 100 }, "slow");

          $.ajax({
            url : "fetch_latest_posts.php",
            method : "GET",
            //async: false,
            data : {last_post_id : $('.card-panel').last().data('id')},
            success : function(data){
              if(data === "No more posts"){
                window.no_more_posts = true;
              }
              $('.container-of-posts').append(data);
              $("#loading").hide();
              X = true;
            },
            error : function(e){
              alert(e);
            }
           });

          // fetch(`fetch_latest_posts.php?last_post_id=${$('.card-panel').last().data('id')}`)
          // .then(data => {
          //   return data.text();
          // })
          // .then(data => {
          //   if(data == "No more posts") window.no_more_posts = true;
          //   $("#loading").hide();
          //   $('.container-of-posts').append(data);
          // })

         }
      });
    </script>

  </body>
</html>
