<?php
$sessionUserType = $this->session->userdata('usertype');
$sessionUser_id = $this->session->userdata('user_id');
$this->load->view('header');
$this->load->view('menu');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title; ?></a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <form class="form-horizontal" method="POST" name="cityForm" id="cityForm"
                            action="<?php echo base_url("City/" . $formAction); ?>">
                            <div class="box-body">

                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group" style="padding:10px">
                                            <label for="">City Name</label>
                                            <input type="text" tabindex="1"
                                                class="input-block-level input_validate  form-control"
                                                placeholder="City Name" name="city_name"
                                                value="<?php echo $city_name; ?>" id="city_name">
                                            <input type="hidden" name="city_id" value="<?php echo $city_id; ?>"
                                                id="city_id">

                                        </div>
                                    </div>



                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group" style="padding:10px">
                                    <label for="">Country</label>
                                    <select class="input-large m-wrap input_validate form-control" tabindex="1"
                                        name="country_id" id="country_id">
                                        <option value="">Select Country</option>
                                        <?php
                                        if ($countryLists) {
                                            foreach ($countryLists as $countryList) {
                                                ?>
                                                <option value="<?php echo $countryList->country_id ?>" <?php if ($countryList->country_id == $country_id) {
                                                       echo "selected";
                                                   } ?>>
                                                    <?php echo $countryList->country_name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group" style="padding:10px">
                                    <label for="">State</label>
                                    <select class="input-large m-wrap input_validate form-control" tabindex="1"
                                        name="state_id" id="state_id">
                                        <option value="">Select State</option>
                                        <?php
                                        if ($stateLists) {
                                            foreach ($stateLists as $stateList) {
                                                ?>
                                                <option value="<?php echo $stateList->state_id ?>" <?php if ($stateList->state_id == $state_id) {
                                                       echo "selected";
                                                   } ?>>
                                                    <?php echo $stateList->state_name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group" style="padding:10px">
                                    <label for="">City Short Name</label>
                                    <input type="text" tabindex="1"
                                        class="input-block-level input_validate  form-control"
                                        placeholder="City Short Name" name="city_short_name"
                                        value="<?php echo $city_short_name; ?>" id="city_short_name">
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group" style="padding:10px">
                                    <label for="">Status</label>
                                    <select class="input-large m-wrap input_validate form-control" tabindex="1"
                                        name="city_status" id="city_status">
                                        <option value="">Status</option>
                                        <option value="1" <?php if ($city_status == 1) {
                                            echo "selected";
                                        } ?>>
                                            Enable</option>
                                        <option value="2" <?php if ($city_status == 2) {
                                            echo "selected";
                                        } ?>>
                                            Disable</option>
                                    </select>
                                </div>
                            </div>

                            
                            </div>

                            <div class="row" id="cityAreaContainer">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group" style="padding:10px">
                                        <label for="">City Area Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="city_area_name" placeholder="Add City Area Names below">
                                            <span class="input-group-addon delete-icon" style="cursor:pointer; display:none;" onclick="deleteCityArea(this)">&times;</span>
                                        </div>
                                        <div id="cityAreaList" class="mt-2"></div> 
                                        <button type="button" class="btn btn-primary mt-2" onclick="addCityArea()">Add City Area</button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="city_area_names" id="city_area_names" value="<?php echo isset($city_area_names) ? $city_area_names : ''; ?>">
                            <input type="hidden" name="deleted_area_ids" id="deleted_area_ids" value=""> 



                            </div>

                    </div>

                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <a href="<?php echo base_url(); ?>City" class="btn btn-primary pull-right"
                    style="margin-left:5px"><i class=" icon-remove"></i> Cancel </a>
                <button type="submit" class="btn  btn-success pull-right"
                    onclick='return formValidation("cityForm");'>Submit</button>

            </div><!-- /.box-footer -->
            </form>

        </div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</section>
</div>
<?php $this->load->view('footer'); ?>
<script>
    function formValidation(fromName) {

        // Validate the entries
        var valid = true,
            params;

        //Remove any previous errors
        jQuery("#" + fromName + " .input_validate").each(function () {
            jQuery(this).removeClass('error_cl');
        });

        // Loop through required field
        jQuery("#" + fromName + " .input_validate").each(function () {

            // Check the min length
            if (jQuery(this).val().length < 1) {
                jQuery(this).addClass("error_cl");
                valid = false;
            }
        });

        if (valid === true) {
            $.ajax({
                url: '<?php echo base_url("city/check_duplicate_city"); ?>',
                method: 'POST',
                data: $('#cityForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        alert(response.message);
                    } else {
                        $('#cityForm')[0].submit();
                    }
                },
                error: function() {
                    alert('There was an error with the request.');
                }
            });
        }
        return false;
    }

document.addEventListener("DOMContentLoaded", function() {
    const existingAreaNames = "<?php echo isset($city_area_names) ? $city_area_names : ''; ?>".split(',');
    const existingAreaIds = "<?php echo isset($city_area_ids) ? $city_area_ids : ''; ?>".split(',');

    existingAreaNames.forEach((areaName, index) => {
        if (areaName) {
            addCityAreaToDOM(areaName, existingAreaIds[index]); 
        }
    });
});

function addCityAreaToDOM(cityAreaName, areaId = null) {
    const newDiv = document.createElement('div');
    newDiv.className = 'input-group mt-2'; 

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.className = 'form-control';
    newInput.placeholder = 'City Area Name';
    newInput.value = cityAreaName;

    if (areaId) {
        newInput.dataset.areaId = areaId; // Store the ID for updates
    }

    // Add an event listener to update hidden field when value changes
    newInput.addEventListener('input', updateHiddenCityAreas);

    const deleteIcon = document.createElement('span');
    deleteIcon.className = 'input-group-addon delete-icon';
    deleteIcon.style.cursor = 'pointer';
    deleteIcon.style.color = 'red';
    deleteIcon.onclick = function() {
        deleteCityArea(this);
        updateHiddenCityAreas();
    };
    deleteIcon.innerHTML = '&times;';

    newDiv.appendChild(newInput);
    newDiv.appendChild(deleteIcon);
    
    document.getElementById('cityAreaList').appendChild(newDiv); 
}


function addCityArea() {
    const inputField = document.getElementById('city_area_name');
    const cityAreaName = inputField.value.trim();
    const existingAreas = Array.from(document.querySelectorAll('#cityAreaList .input-group input')).map(input => input.value.trim());

    if (cityAreaName) {
        if (existingAreas.includes(cityAreaName)) {
            alert('This city area name already exists. Please enter a different name.');
            return;
        }

        addCityAreaToDOM(cityAreaName); 
        inputField.value = ''; 
        updateHiddenCityAreas();
    } else {
        alert('Please enter a city area name.');
    }
}

function deleteCityArea(element) {
    const inputGroup = element.parentElement; 
    const areaId = inputGroup.querySelector('input').dataset.areaId; 

    if (areaId) {
        const deletedIdsField = document.getElementById('deleted_area_ids');
        const existingDeletedIds = deletedIdsField.value ? deletedIdsField.value.split(',') : [];
        
        if (!existingDeletedIds.includes(areaId)) {
            existingDeletedIds.push(areaId);
            deletedIdsField.value = existingDeletedIds.join(','); 
        }
    }

    inputGroup.parentElement.removeChild(inputGroup);
    updateHiddenCityAreas();
}

function updateHiddenCityAreas() {
    const areas = Array.from(document.querySelectorAll('#cityAreaList .input-group input')).map(input => {
        return input.value.trim();
    }).filter(name => name !== '');

    document.getElementById('city_area_names').value = areas.join(',');
}

</script>

</body>

</html>