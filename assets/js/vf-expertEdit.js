$(document).ready(function(){
  function getUrlVars()
  {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }

    $('#inputDOB').datetimepicker({format: 'MM/DD/YYYY'}); // activate date-picker 
    fetchExpert(); // get expert object 
    
    // FETCH EXPERT 
    function fetchExpert(){
        var exp = new SObjectModel.exp();
        exp.retrieve({
            where:{
               Id: {eq: getUrlVars()["Id"]}
            },
            limit: 1
        }, function(err,records){
            if(err) {
                alert(err.message);
            }else {
                records.forEach(function(record){

                    var expObj = {
                        Id: record.get('Id'),
                        title: record.get('Ms_Mr_Dr_Nurse__c'),
                        firstName: record.get('Firstname__c'),
                        lastName: record.get('Lastname__c'),
                        mobile: record.get('Mobile__c'),
                        email: record.get('Email__c'),
                        imageURL: record.get('Image_URL__c'),
                        dateOfBirth: record.get('Date_of_birth__c'),
                        address1: record.get('Address__c'),
                        address2: record.get('Address2__c'),
                        city: record.get('City__c'),
                        state: record.get('State__c'),
                        zip: record.get('ZIP__c'),
                        hourlyReviewFee: record.get('Hourly_Review_Fee__c'),
                        hourlyDepositionFee: record.get('Hourly_Deposition_Fee__c'),
                        hourlyCourtFee: record.get('Hourly_Court_Fee__c'),
                        feeComments: record.get('Fee_Comments__c'),
                        specialtyArea: record.get('Specialty_Area__c'),
                        legalExperience: record.get('Legal_Experience__c')
                    }
                    console.log(expObj);
                    
                    // Expert Object ID 
                    $('#expertID').val(expObj.Id);
                    //title 
                    $('#inputTitle').val(expObj.title);
                    //first name 
                    $('#inputFirstName').val(expObj.firstName);
                    // last Name 
                    $('#inputLastName').val(expObj.lastName);
                    // mobile number 
                    $('#inputMobile').val(expObj.mobile);
                    //email 
                    $('#inputEmail').val(expObj.email);
                    // avatar image url 
                    $('#inputImageUrl').val(expObj.imageURL);
                    //Date of birth 
                    $('#inputDOB').val(moment(expObj.dateOfBirth).format('MM/DD/YYYY'));
                    
                    // address line 1
                    $('#inputAddressLine1').val(expObj.address1);
                    // address line 2 
                    $('#inputAddressLine2').val(expObj.address2);
                    // city 
                    $('#inputCityTown').val(expObj.city);
                    // state 
                    $('#inputStateProvinceRegion').val(expObj.state);
                    // zip 
                    $('#inputZipPostalCode').val(expObj.zip);

                    // hourly review fee 
                    $('#inputHourlyReview').val(expObj.hourlyReviewFee);
                    // hourly deposition fee
                    $('#inputHourlyDeposition').val(expObj.hourlyDepositionFee);
                    // hourly court fee 
                    $('#inputHourlyCourt').val(expObj.hourlyCourtFee);
                    // fee comments 
                    $('#inputFeeComments').val(expObj.feeComments);

                    // specialtyArea 
                    $('#inputSpecialtyArea').val(expObj.specialtyArea);
                    // legal experience 
                    $('#inputLegalExperience').val(expObj.legalExperience);
                });
            }
        
        });
    } // end fetchExpert 

    // Create / update expert 
    function createExpert(){

      var updateExp = new SObjectModel.exp({
          Ms_Mr_Dr_Nurse__c: $('#inputTitle').val(),
          Firstname__c: $('#inputFirstName').val(),
          Lastname__c: $('#inputLastName').val(),
          Mobile__c: $('#inputMobile').val(),
          Email__c: $('#inputEmail').val(),
          Image_URL__c: $('#inputImageUrl').val(),
          Date_of_birth__c: moment($('#inputDOB').val()).toDate(), //convert to date object 
          Address__c: $('#inputAddressLine1').val(),
          Address2__c: $('#inputAddressLine2').val(),
          City__c: $('#inputCityTown').val(),
          State__c:  $('#inputStateProvinceRegion').val(),
          ZIP__c:  $('#inputZipPostalCode').val(),
          Hourly_Review_Fee__c: $('#inputHourlyReview').val(),
          Hourly_Deposition_Fee__c:  $('#inputHourlyDeposition').val(),
          Hourly_Court_Fee__c: $('#inputHourlyCourt').val(),
          Fee_Comments__c: $('#inputFeeComments').val(),
          Specialty_Area__c: $('#inputSpecialtyArea').val(),
          Legal_Experience__c:  $('#inputLegalExperience').val()
      });
       expertID = $('#expertID').val();

      //If expertID is null then Create new Expert
      if(!expertID){
        updateExp.create(updateCallback);
      }else{
      //Id expertID has value then update the Expert record
        updateExp.set('Id',expertID);
        updateExp.update(updateCallback);
      }
    }// end createExpert

    // Callback to handle DML Remote Objects calls
    function updateCallback(err, ids){
      if (err) { 
          alert(err); 
      } else {
          alert('SAVED!');
          console.log('saved')
      }
    }

    // disabled editing on load 
    // $('.form-control').prop('disabled',true);
    

    // Edit button Click 
    $('#btnEdit').click(function(e){
      e.preventDefault();
      if($('.form-control').prop('disabled')){
        $('.form-control').removeProp('disabled');
      }else {
        $('.form-control').prop('disabled',true);
      }
    });


    // cancel button click 
    $('#btnCancel').click(function(e){
      e.preventDefault();
      fetchExpert();
    });
    //Save button click       
    $('#btnSave').click(function(e){ 
      e.preventDefault();
      createExpert();
    });







}); //end ready