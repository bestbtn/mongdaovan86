
<!DOCTYPE html>
<html lang="en">
<body>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <br />
        <h2 align="center">Advance Ajax Product Filters in PHP</h2>
        <br />
        <div class="col-md-3">
            <div class="list-group">
                <h3>Price</h3>
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="65000" />
                <p id="price_show">1000 - 65000</p>
                <div id="price_range"></div>
            </div>
            <div class="list-group">
                <h3>Brand</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php
                    foreach($result as $row)
                    {
                        ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['product_brand']; ?>"  > <?php echo $row['product_brand']; ?></label>
                        </div>
                        <?php
                    }

                    ?>
                </div>
            </div>

            <div class="list-group">
                <h3>RAM</h3>
                <?php ;
                foreach($result as $row)
                {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['product_ram']; ?>" > <?php echo $row['product_ram']; ?> GB</label>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="list-group">
                <h3>Internal Storage</h3>
                <?php
                foreach($result as $row)
                {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="<?php echo $row['product_storage']; ?>"  > <?php echo $row['product_storage']; ?> GB</label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-9">
            <br />
            <div class="row filter_data">

            </div>
        </div>
    </div>

</div>
<style>
    #loading
    {
        text-align:center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>
<script>
    $(document).ready(function(){

        filter_data();

        function filter_data()
        {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var ram = get_filter('ram');
            var storage = get_filter('storage');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
                success:function(data){
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });

        $('#price_range').slider({
            range:true,
            min:1000,
            max:65000,
            values:[1000, 65000],
            step:500,
            stop:function(event, ui)
            {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
            }
        });

    });
</script>

</body>

</html>