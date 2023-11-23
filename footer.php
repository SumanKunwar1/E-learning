<footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © <?php echo date('Y') ?> NextGen. All rights reserved.</p>
            </div>
        </div>
    </footer>
  

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./assets/js/isotope.min.js"></script>
    <script src="./assets/js/owl-carousel.js"></script>
    <script src="./assets/js/counter.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./Validations/script.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="./js/all.min.js"></script>

    <!-- Student Testimonial Owl Slider JS  -->
    <script type="text/javascript" src="./js/owl.min.js"></script>
    <script type="text/javascript" src="./js/testyslider.js"></script>

    <!-- Student Ajax Call JavaScript -->
    <script type="text/javascript" src="./js/ajaxrequest.js"></script>

    <!-- Admin Ajax Call JavaScript -->
    <script type="text/javascript" src="./js/adminajaxrequest.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="./js/custom.js"></script>
    <script>
  $(document).ready(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('#backToTopBtn').fadeIn();
      } else {
        $('#backToTopBtn').fadeOut();
      }
    });

    $('#backToTopBtn').click(function() {
      $('html, body').animate({ scrollTop: 0 }, 'slow');
      return false;
    });
  });
</script>
</body>

</html>