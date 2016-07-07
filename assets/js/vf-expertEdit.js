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
                        legalExperience: record.get('Legal_Experience__c'),
                        State_List__c: record.get('State_List__c'),
                        Country__c: record.get('Country__c')
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
          Country__c: $('#inputCountry').val(),
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
      alert('Form Reset');
      $(this).blur();
      fetchExpert();
    });
    //Save button click       
    $('#btnSave').click(function(e){ 
      e.preventDefault();
      createExpert();
    });

    $('#inputCountry').on('change', function(e){
      var value = e.target.value;
      console.log(value, e);
      switch (value){
        case "US":
          $('#inputStateProvinceRegion-container').html(stateUS);
          break;
        case "CA":
        $('#inputStateProvinceRegion-container').html(stateCanada);
          break;
        default:
          $('#inputStateProvinceRegion-container').html(stateInput);
          break;
      }
    });

    // input for non-north american countries
    var stateInput="";
    stateInput += "            <input type=\"text\" class=\"form-control\" id=\"inputStateProvinceRegion\" name=\"state-province-region\" placeholder=\"State \/ Province \/ Region\" \/>";

    var stateCanada="";
    stateCanada += "<select name=\"state-province-region\" class=\"form-control\" id=\"inputStateProvinceRegion\">";
    stateCanada += "  <option value=\"AB\">Alberta<\/option>";
    stateCanada += "  <option value=\"BC\">British Columbia<\/option>";
    stateCanada += "  <option value=\"MB\">Manitoba<\/option>";
    stateCanada += "  <option value=\"NB\">New Brunswick<\/option>";
    stateCanada += "  <option value=\"NL\">Newfoundland and Labrador<\/option>";
    stateCanada += "  <option value=\"NS\">Nova Scotia<\/option>";
    stateCanada += "  <option value=\"ON\">Ontario<\/option>";
    stateCanada += "  <option value=\"PE\">Prince Edward Island<\/option>";
    stateCanada += "  <option value=\"QC\">Quebec<\/option>";
    stateCanada += "  <option value=\"SK\">Saskatchewan<\/option>";
    stateCanada += "  <option value=\"NT\">Northwest Territories<\/option>";
    stateCanada += "  <option value=\"NU\">Nunavut<\/option>";
    stateCanada += "  <option value=\"YT\">Yukon<\/option>";
    stateCanada += "<\/select>  ";

    var stateUS="";
    stateUS += "              <select name=\"state-province-region\" class=\"form-control\" id=\"inputStateProvinceRegion\">";
    stateUS += "                <option value=\"AL\">Alabama<\/option>";
    stateUS += "                <option value=\"AK\">Alaska<\/option>";
    stateUS += "                <option value=\"AZ\">Arizona<\/option>";
    stateUS += "                <option value=\"AR\">Arkansas<\/option>";
    stateUS += "                <option value=\"CA\">California<\/option>";
    stateUS += "                <option value=\"CO\">Colorado<\/option>";
    stateUS += "                <option value=\"CT\">Connecticut<\/option>";
    stateUS += "                <option value=\"DE\">Delaware<\/option>";
    stateUS += "                <option value=\"DC\">District Of Columbia<\/option>";
    stateUS += "                <option value=\"FL\">Florida<\/option>";
    stateUS += "                <option value=\"GA\">Georgia<\/option>";
    stateUS += "                <option value=\"HI\">Hawaii<\/option>";
    stateUS += "                <option value=\"ID\">Idaho<\/option>";
    stateUS += "                <option value=\"IL\">Illinois<\/option>";
    stateUS += "                <option value=\"IN\">Indiana<\/option>";
    stateUS += "                <option value=\"IA\">Iowa<\/option>";
    stateUS += "                <option value=\"KS\">Kansas<\/option>";
    stateUS += "                <option value=\"KY\">Kentucky<\/option>";
    stateUS += "                <option value=\"LA\">Louisiana<\/option>";
    stateUS += "                <option value=\"ME\">Maine<\/option>";
    stateUS += "                <option value=\"MD\">Maryland<\/option>";
    stateUS += "                <option value=\"MA\">Massachusetts<\/option>";
    stateUS += "                <option value=\"MI\">Michigan<\/option>";
    stateUS += "                <option value=\"MN\">Minnesota<\/option>";
    stateUS += "                <option value=\"MS\">Mississippi<\/option>";
    stateUS += "                <option value=\"MO\">Missouri<\/option>";
    stateUS += "                <option value=\"MT\">Montana<\/option>";
    stateUS += "                <option value=\"NE\">Nebraska<\/option>";
    stateUS += "                <option value=\"NV\">Nevada<\/option>";
    stateUS += "                <option value=\"NH\">New Hampshire<\/option>";
    stateUS += "                <option value=\"NJ\">New Jersey<\/option>";
    stateUS += "                <option value=\"NM\">New Mexico<\/option>";
    stateUS += "                <option value=\"NY\">New York<\/option>";
    stateUS += "                <option value=\"NC\">North Carolina<\/option>";
    stateUS += "                <option value=\"ND\">North Dakota<\/option>";
    stateUS += "                <option value=\"OH\">Ohio<\/option>";
    stateUS += "                <option value=\"OK\">Oklahoma<\/option>";
    stateUS += "                <option value=\"OR\">Oregon<\/option>";
    stateUS += "                <option value=\"PA\">Pennsylvania<\/option>";
    stateUS += "                <option value=\"RI\">Rhode Island<\/option>";
    stateUS += "                <option value=\"SC\">South Carolina<\/option>";
    stateUS += "                <option value=\"SD\">South Dakota<\/option>";
    stateUS += "                <option value=\"TN\">Tennessee<\/option>";
    stateUS += "                <option value=\"TX\">Texas<\/option>";
    stateUS += "                <option value=\"UT\">Utah<\/option>";
    stateUS += "                <option value=\"VT\">Vermont<\/option>";
    stateUS += "                <option value=\"VA\">Virginia<\/option>";
    stateUS += "                <option value=\"WA\">Washington<\/option>";
    stateUS += "                <option value=\"WV\">West Virginia<\/option>";
    stateUS += "                <option value=\"WI\">Wisconsin<\/option>";
    stateUS += "                <option value=\"WY\">Wyoming<\/option>";
    stateUS += "                <option value=\"AS\">American Samoa<\/option>";
    stateUS += "                <option value=\"GU\">Guam<\/option>";
    stateUS += "                <option value=\"MP\">Northern Mariana Islands<\/option>";
    stateUS += "                <option value=\"PR\">Puerto Rico<\/option>";
    stateUS += "                <option value=\"UM\">United States Minor Outlying Islands<\/option>";
    stateUS += "                <option value=\"VI\">Virgin Islands<\/option>     ";
    stateUS += "              <\/select>";




}); //end ready