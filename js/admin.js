
      $('a.btn-side').click(function() {
        var page = $(this).attr('name');
      $('a.btn-side').removeClass('active');
        $(this).addClass('active');
        $(".result").html('');
        $("#content").load(base_url + 'page.php?page=' + page);
      });

$(document).on("click", '.a-view', function () {  
  var page = $(this).attr('name');
  var id = $(this).attr('value');
  window.open(base_url + "?page=" + page + "&id=" + id, '_blank');
});


$(document).on("click", '.btn-edit, .btn-view', function () {
  
  var page = $(this).attr('name');
  var id = $(this).attr('value');
  
  $(".result").html('');
  $("#content").load(base_url + 'page.php?page=' + page + '&id=' + id);
  
});

$(document).on("submit", 'form', function (e) {
  e.preventDefault();
  clearErrors();
  var form_raw = this;
  var form_name = this.name;
  var type = e.originalEvent.submitter.name;
  var type_value = e.originalEvent.submitter.value;
  if (this.name == 'logout') {
    window.location.href = base_url+'/logout.php';
  }
  
  formdata = new FormData(this);
  formdata.append('form', form_name);
  formdata.append(type, type_value);

  $.ajax({
    method: "POST",
    url: base_url + "/request.php",
    data: formdata,
    processData: false,
    contentType: false,
    success: function (res) {
      var result = JSON.parse(res);
      $('.result').html(result.result);
      if (result.status == true) {
        $(form_raw).trigger('reset');
      }
      if (result.status == true) {
       if (form_name == 'create_branch') {
         $( "#content" ).load( base_url+'page.php?page=admin/branch_add' );
       }
       if (form_name == 'update_branch' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/branch_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_branch' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/branches');
        }
        
       if (form_name == 'create_plan') {
         $( "#content" ).load( base_url+'page.php?page=admin/plan_add' );
       }
       if (form_name == 'update_plan' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/plan_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_plan' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/plans');
        }
        
       if (form_name == 'create_equipment') {
         $( "#content" ).load( base_url+'page.php?page=admin/equipment_add' );
       }
       if (form_name == 'update_equipment' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/equipment_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_equipment' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/equipments');
        }
        
       if (form_name == 'create_workout') {
         $( "#content" ).load( base_url+'page.php?page=admin/workout_add' );
       }
       if (form_name == 'update_workout' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/workout_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_workout' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/workouts');
        }

        if (form_name == 'create_supplement') {
         $( "#content" ).load( base_url+'page.php?page=admin/supplement_add' );
       }
       if (form_name == 'update_supplement' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/supplement_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_supplement' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/supplements');
        }

        if (form_name == 'create_client') {
         $( "#content" ).load( base_url+'page.php?page=admin/client_add' );
       }
       if (form_name == 'update_client' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/client_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_client' && (formdata.get('delete') != null || formdata.get('verify') != null)) {
         $( "#content" ).load( base_url+'page.php?page=admin/clients');
        }
        
        if (form_name == 'create_trainer') {
         $( "#content" ).load( base_url+'page.php?page=admin/trainer_add' );
       }
       if (form_name == 'update_trainer' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/trainer_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_trainer' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/trainers');
        }
        
        if (form_name == 'create_employee') {
         $( "#content" ).load( base_url+'page.php?page=admin/employee_add' );
       }
       if (form_name == 'update_employee' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/employee_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_employee' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/employees');
        }
        
        if (form_name == 'create_client_plan') {
         $( "#content" ).load( base_url+'page.php?page=admin/client_plan_add' );
       }
       if (form_name == 'update_client_plan' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/client_plan_edit&id='+formdata.get('id') );
        }
       if (form_name == 'update_client_plan' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/client_plans');
        }
        
                
        if (form_name == 'create_service') {
         $( "#content" ).load( base_url+'page.php?page=admin/services_add' );
       }
       if (form_name == 'update_service' && formdata.get('delete') == null) {
         $( "#content" ).load( base_url+'page.php?page=admin/service_edit&id='+formdata.get('id'));
        }
               if (form_name == 'update_service' && formdata.get('delete') != null) {
         $( "#content" ).load( base_url+'page.php?page=admin/services');
        }
        

        
       if (form_name == 'update_user' && type_value == 'update' && formdata.get('access') == null) {
         $( "#content" ).load( base_url+'page.php?page=customer_edit&id=' +formdata.get('user_id'));
       }
       if (form_name == 'update_user' && type_value == 'update' && formdata.get('access')) {
         $( "#content" ).load( base_url+'page.php?page=user_edit&id=' +formdata.get('user_id'));
       }
 
      }
      if (result.items != '') {
        errorFields(result.items);
      }
    }
  });
});




