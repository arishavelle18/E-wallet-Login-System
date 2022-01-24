
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   
     <script>
        function checktime(){
            $.ajax({
                url:"<?php echo base_url();?>Checker/timecheck",
                type:"post",
                success:function(data){
                        console.log(data);
                }
            })
        }
        checktime();

        setInterval("checktime()",1000);

     </script>
</body>
</html>