<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.3.2.min.js"></script>

<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
	width:400px;
  }
  </style>
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  
  <script src="<?php echo base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui.js"></script>
  <script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });
  } );
  </script>



<h3 style="text-align: center;">Sales Product </h3>
<hr>
<h4 style="text-align: center;">
    <?php
        $message=$this->session->userdata('message');
        if(isset($message))
        {
            echo $message;
            $this->session->unset_userdata('message');
        }
    
    
    ?>
</h4>

<h5 id="err_msg" style="margin-left: 200px; color: red;"></h5>

<script type="text/javascript">

    $(document).ready(function() {

        var counter = 2;

        $("#addButton").click(function() {

            if (counter > 10) {
                alert("Only 10 textboxes allow");
                return false;
            }

            var newTextBoxDiv = $(document.createElement('tr'))
                    .attr("id", 'TextBoxDiv' + counter);




            newTextBoxDiv.before().html('<label>Product ID #' + counter + ' : </label>' +
                    '<input type="text" name="product_id[]" id="product_id'+counter+'" onblur="isProductExists(this);" size="15" required="required" value="">' + '<label>Quantity : </label>' +
                    '<input type="number" name="quantity[]" required="required">'+
                    '<label>Unit Price : </label>' +'<input type="number" name="unit_price[]" required="required" value="">');

            newTextBoxDiv.appendTo("#add_sales");


            counter++;
        });

        $("#removeButton").click(function() {
            if (counter == 1) {
                alert("No more textbox to remove");
                return false;
            }

            counter--;

            $("#TextBoxDiv" + counter).remove();

        });

        $("#getButtonValue").click(function() {

            var msg = '';
            for (i = 1; i < counter; i++) {
                msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
            }
            alert(msg);
        });
    });
</script>


<?php if($this->session->userdata('role') == 1||$this->session->userdata('role') == 3): ?>

<div id="add_sales_form">
    <form action="<?php echo base_url();?>store_category/save_sales_product" method="post" id="add_sales">
    
   <div style="padding-left:10px">
    <table cellspacing="10px" align="left" style="margin-bottom:0px !important">
        <tr>
            <td>Date</td>
            <td>
     <input type='date' id='date' name='date[]' required="required" value="">
            </td>
        </tr>
        <tr>
            <td>Customer ID</td>
            <td>
    <!--<input type="text" name="customer_id[]" size="15" required="required" value="">-->
    <!--<input type="search" list="student_id_list" placeholder="Enter Student ID" name="student_id" style="width:300px">
    <datalist id="student_id_list">
        <?php
        //foreach ($student_list as $values) {
            ?>
		<option value="<?php //echo $values->customer_id;?>"><?php //echo $values->customer_name?></option>
        <?php //} ?>-->

    </datalist>
    
    <select name="customer_id[]" required="required" id="combobox" style="250px">
    	<option value="">-- Select Customer ID --</option>
        <?php
        foreach ($student_list as $values) {
            ?>
			<option value="<?php echo $values->customer_id; ?>"><?php echo $values->customer_id.'~'.$values->customer_name; ?></option>
        <?php } ?>
   </select>
    
            </td>
        </tr>
    </table>
   </div> 
    
    <table cellspacing="10px" align="center">
        <tr>
            <td>Product ID</td>
            <td>
      <input type="text" name="product_id[]" id="product_id1" onblur="isProductExists(this);" size="15" required="required" value="">
            </td>
        
            <td>Quantity</td>
            <td>
      <input type="number" name="quantity[]" required="required" value="">
            </td>
        
            <td>Unit Price</td>
            <td>
      <input type="number" name="unit_price[]"  required="required" value="">
            </td>
            
        </tr>

        
        <tr>
            <td>
        <input type='button' value='Add More Product!' id='addButton'>
            </td>
            <td>
        <input type='button' value='Remove One' id='removeButton'>
            </td>
            <td>
        <input type="submit" name="btn" id="btn" value="Save">
            </td>
        </tr>
    </table>
</form> 
</div>

<?php endif;?>

<script type="text/javascript">
    function isProductExists(id) {
        var product_id = id.value;

        if(id.value != ''){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>store_category/isProductExists/",
                data: {product_id:product_id},
                dataType: "html",
                success: function(data) {

                    if(data == 'Exist!'){
                        $("#err_msg").text("");
                        $("#btn").attr("disabled", false);
                    }

                    if(data == 'Not Exists!'){
                        $("#err_msg").text("Sorry, Product ID is not " + data);
                        $("#btn").attr("disabled", true);
                    }
                }
            });
        }

    }
</script>
