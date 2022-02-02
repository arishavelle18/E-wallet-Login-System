
     
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