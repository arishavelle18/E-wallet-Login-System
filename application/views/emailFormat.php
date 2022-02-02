    <body>
        <div class = "container">
            <div class ="row">
                <div class = "col-md-4">
                    <div class = "card" style = "margin-top: 5rem">
                    <h1>
                        <?php echo $header?>
                    </h1>
                    <p> Hello <?php echo $username?></p>
                    <br>
                    <p><?php echo $body?></p>
                    <form action="<?php echo $link?>">
                        
                        <input type = "submit" class="btn btn-success" value='<?php echo $button?>'/>
                    </form>
                    </div>
                </div>
            </div>
        </div>