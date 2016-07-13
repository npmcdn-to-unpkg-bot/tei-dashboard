$(document).ready(function(){
  console.log('Expert Profile Script running....');
  
  // add image upload function 
  handleCloudinaryUpload();

  var _EID,
      _IMGVER;


    //init iframe 
    window.iFrameResizer = {
        readyCallback: function() {
            if ('parentIFrame' in window) {
                window.parentIFrame.sendMessage('loading-hide');
                window.parentIFrame.scrollToOffset(0, 0);

            }

        },
        messageCallback: function(message) {
            console.dir(message);
            if (message.action == 'HIRE') {
                hireExpert(message.expertURL);
            }
        }
    };

  //on page change - show loading 
  $(window).on('beforeunload ', function() {
      if ('parentIFrame' in window) {
          window.parentIFrame.sendMessage('loading-show');
          window.parentIFrame.scrollToOffset(0, 0);
      }
  });

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
                        E_ID: record.get('E_ID__c'),
                        title: record.get('Ms_Mr_Dr_Nurse__c'),
                        firstName: record.get('Firstname__c'),
                        lastName: record.get('Lastname__c'),
                        mobile: record.get('Mobile__c'),
                        email: record.get('Email__c'),
                        imageURL: record.get('Image_URL__c'),
                        imageVersion: record.get('Image_Version__c'),
                        dateOfBirth: record.get('Date_of_birth__c'),
                        address1: record.get('Address__c'),
                        address2: record.get('Address2__c'),
                        city: record.get('City__c'),
                        state: record.get('State_List__c'),
                        country: record.get('Country__c'),
                        zip: record.get('ZIP__c'),
                        hourlyReviewFee: record.get('Hourly_Review_Fee__c'),
                        hourlyDepositionFee: record.get('Hourly_Deposition_Fee__c'),
                        hourlyCourtFee: record.get('Hourly_Court_Fee__c'),
                        feeComments: record.get('Fee_Comments__c'),
                        specialtyArea: record.get('Specialty_Area__c'),
                        legalExperience: record.get('Legal_Experience__c')                       
                    }
                    console.log('LOADED EXPERT:',expObj);
                    
                    // Expert Object ID 
                    $('#expertID').val(expObj.Id);
                    // EID 
                    $('#EID').val(expObj.E_ID);  

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
                    // country 
                    $('#inputCountry').val(expObj.country);                    
                    // state 
                    // $('#inputStateProvinceRegion').val(expObj.state);
                    handleCountryChange(expObj.country, expObj.state);


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

                    //expose global variables
                    _EID = expObj.E_ID; 
                    _IMGVER = expObj.imageVersion;
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
          Date_of_birth__c: moment($('#inputDOB').val()).toDate(), //convert to date object 
          Address__c: $('#inputAddressLine1').val(),
          Address2__c: $('#inputAddressLine2').val(),
          City__c: $('#inputCityTown').val(),
          State_List__c:  $('#inputStateProvinceRegion').val(),
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
          $('#btnSave').attr('disabled', true);
          $('#btnCancel').fadeOut();
          alert('Success: Your Profile Information has been updated');
          // console.log('saved',ids)
      }
    }

    // update profile image 
    function updateProfileImage(imgUrl){
      var updateExpImg = new SObjectModel.exp({
        Image_URL__c: imgUrl
      });
      expertID = $('#expertID').val();
      updateExpImg.set('Id',expertID);
      updateExpImg.update(updateImgCallback);

      //update onpage avatar 
      var resultURL = imgUrl;
          resultURL = resultURL.substring(0,62)+"/c_thumb,g_face,h_120,w_120/"+resultURL.substring(62);
      $('.expert-avatar').attr('src', resultURL);

    }
    function updateImgCallback(err, ids){
      if (err) { 
          alert(err); 
      } else {          

          alert('Success: Your Profile Picture has Been Updated');

      }
    }

    // cancel button click 
    $('#btnCancel').click(function(e){
      e.preventDefault();
      alert('Form Reset');
      $(this).blur();
      fetchExpert();
    });
    //Save button click       
    $('#expert-profile-form').submit(function(e){ 
      e.preventDefault();
    });

    // chang input for region 
    $('#inputCountry').on('change', function(e){
      var value = e.target.value;
      console.log(value, e);
      handleCountryChange(value);
    });

    // handle country select change
    var handleCountryChange = function(country, state){
      switch (country){
        case "United States":
          $('#inputStateProvinceRegion-container').html(stateUS);
          break;
        case "Canada":
        $('#inputStateProvinceRegion-container').html(stateCanada);
          break;
        default:
          $('#inputStateProvinceRegion-container').html(stateNone);
          break;
      }
      $('#inputStateProvinceRegion').val(state);
    }

    function handleCloudinaryUpload(){
      $.cloudinary.config({ cloud_name: 'theexpertinstitute-com', api_key: '111988869247593'});
      $('.cloudinary').append($.cloudinary.unsigned_upload_tag('tei_dashboard_expert_profile_upload', {
                cloud_name: 'theexpertinstitute-com',
                tags: 'expert_dashboard_upload'                     
            }).bind('cloudinarydone', function(e,data){          
              console.log(data.result.url);
              updateProfileImage(data.result.url);
            }));
    }
    // Style file input 
    $("input[type='file']").dropify();

// input for non-north american countries
var stateNone="";
stateNone += "<select name=\"state-province-region\" class=\"form-control\" id=\"inputStateProvinceRegion\">";
stateNone += "  <option value=\"None\" selected=\"selected\">None<\/option>";
stateNone += "<\/select>  ";

var stateCanada="";
stateCanada += "<select name=\"state-province-region\" class=\"form-control\" id=\"inputStateProvinceRegion\">";
stateCanada += "  <option value=\"Alberta\">Alberta<\/option>";
stateCanada += "  <option value=\"British Columbia\">British Columbia<\/option>";
stateCanada += "  <option value=\"Manitoba\">Manitoba<\/option>";
stateCanada += "  <option value=\"New Brunswick\">New Brunswick<\/option>";
stateCanada += "  <option value=\"Newfoundland and Labrador\">Newfoundland and Labrador<\/option>";
stateCanada += "  <option value=\"Nova Scotia\">Nova Scotia<\/option>";
stateCanada += "  <option value=\"Ontario\">Ontario<\/option>";
stateCanada += "  <option value=\"Prince Edward Island\">Prince Edward Island<\/option>";
stateCanada += "  <option value=\"Quebec\">Quebec<\/option>";
stateCanada += "  <option value=\"Saskatchewan\">Saskatchewan<\/option>";
stateCanada += "  <option value=\"Northwest Territories\">Northwest Territories<\/option>";
stateCanada += "  <option value=\"Nunavut\">Nunavut<\/option>";
stateCanada += "  <option value=\"Yukon\">Yukon<\/option>";
stateCanada += "<\/select>  ";

var stateUS="";
stateUS += "              <select name=\"state-province-region\" class=\"form-control\" id=\"inputStateProvinceRegion\">";
stateUS += "              <option value=\"Alabama\">Alabama<\/option>";
stateUS += "              <option value=\"Alaska\">Alaska<\/option>";
stateUS += "              <option value=\"Arizona\">Arizona<\/option>";
stateUS += "              <option value=\"Arkansas\">Arkansas<\/option>";
stateUS += "              <option value=\"California\">California<\/option>";
stateUS += "              <option value=\"Colorado\">Colorado<\/option>";
stateUS += "              <option value=\"Connecticut\">Connecticut<\/option>";
stateUS += "              <option value=\"Delaware\">Delaware<\/option>";
stateUS += "              <option value=\"District Of Columbia\">District Of Columbia<\/option>";
stateUS += "              <option value=\"Florida\">Florida<\/option>";
stateUS += "              <option value=\"Georgia\">Georgia<\/option>";
stateUS += "              <option value=\"Hawaii\">Hawaii<\/option>";
stateUS += "              <option value=\"Idaho\">Idaho<\/option>";
stateUS += "              <option value=\"Illinois\">Illinois<\/option>";
stateUS += "              <option value=\"Indiana\">Indiana<\/option>";
stateUS += "              <option value=\"Iowa\">Iowa<\/option>";
stateUS += "              <option value=\"Kansas\">Kansas<\/option>";
stateUS += "              <option value=\"Kentucky\">Kentucky<\/option>";
stateUS += "              <option value=\"Louisiana\">Louisiana<\/option>";
stateUS += "              <option value=\"Maine\">Maine<\/option>";
stateUS += "              <option value=\"Maryland\">Maryland<\/option>";
stateUS += "              <option value=\"Massachusetts\">Massachusetts<\/option>";
stateUS += "              <option value=\"Michigan\">Michigan<\/option>";
stateUS += "              <option value=\"Minnesota\">Minnesota<\/option>";
stateUS += "              <option value=\"Mississippi\">Mississippi<\/option>";
stateUS += "              <option value=\"Missouri\">Missouri<\/option>";
stateUS += "              <option value=\"Montana\">Montana<\/option>";
stateUS += "              <option value=\"Nebraska\">Nebraska<\/option>";
stateUS += "              <option value=\"Nevada\">Nevada<\/option>";
stateUS += "              <option value=\"New Hampshire\">New Hampshire<\/option>";
stateUS += "              <option value=\"New Jersey\">New Jersey<\/option>";
stateUS += "              <option value=\"New Mexico\">New Mexico<\/option>";
stateUS += "              <option value=\"New York\">New York<\/option>";
stateUS += "              <option value=\"North Carolina\">North Carolina<\/option>";
stateUS += "              <option value=\"North Dakota\">North Dakota<\/option>";
stateUS += "              <option value=\"Ohio\">Ohio<\/option>";
stateUS += "              <option value=\"Oklahoma\">Oklahoma<\/option>";
stateUS += "              <option value=\"Oregon\">Oregon<\/option>";
stateUS += "              <option value=\"Pennsylvania\">Pennsylvania<\/option>";
stateUS += "              <option value=\"Rhode Island\">Rhode Island<\/option>";
stateUS += "              <option value=\"South Carolina\">South Carolina<\/option>";
stateUS += "              <option value=\"South Dakota\">South Dakota<\/option>";
stateUS += "              <option value=\"Tennessee\">Tennessee<\/option>";
stateUS += "              <option value=\"Texas\">Texas<\/option>";
stateUS += "              <option value=\"Utah\">Utah<\/option>";
stateUS += "              <option value=\"Vermont\">Vermont<\/option>";
stateUS += "              <option value=\"Virginia\">Virginia<\/option>";
stateUS += "              <option value=\"Washington\">Washington<\/option>";
stateUS += "              <option value=\"West Virginia\">West Virginia<\/option>";
stateUS += "              <option value=\"Wisconsin\">Wisconsin<\/option>";
stateUS += "              <option value=\"Wyoming\">Wyoming<\/option>";
stateUS += "              <option value=\"American Samoa\">American Samoa<\/option>";
stateUS += "              <option value=\"Guam\">Guam<\/option>";
stateUS += "              <option value=\"Northern Mariana Islands\">Northern Mariana Islands<\/option>";
stateUS += "              <option value=\"Puerto Rico\">Puerto Rico<\/option>";
stateUS += "              <option value=\"United States Minor Outlying Islands\">United States Minor Outlying Islands<\/option>";
stateUS += "              <option value=\"Virgin Islands \">Virgin Islands <\/option>    ";
stateUS += "              <\/select>";




// validate form 
$('#expert-profile-form').validate({
    debug: true,
    ignore: ".ignore",
    rules: {
      firstname:{
        required: true
      },
      lastname: {
        required: true
      },
      mobile: {
        required: true,
        phoneUS: true
      },
      email: {
        required: true,
        email: true
      },
      "inputHourlyReview": {
        required: true
      },
      "hiddenRecaptcha": {
        required: function() {
          if(grecaptcha.getResponse() == ''){
            return true;
          } else {
            return false;
          }
        }
      }
    },
    messages: {
      firstname: {
        required: "Please enter your first name"
      },
      lastname: {
        required: "Please enter your last name"
      },
      mobile: {
        required: "Please enter a phone number",
        phoneUS: "Number must be formatted like: 555-555-5555"
      },
      email: {
        required: "Please enter your email address",
        email: "Enter a valid email address"
      },
      "inputSpecialtyArea": {
        required: "Please enter your field of specialization"
      },
      "inputHourlyReview": {
        required: "please enter your hourly rate"
      },
      "hiddenRecaptcha": {
        required: "Please verify that you're human."
      }

    },
    submitHandler: function(form){
      console.log('form submmiting...');
      if(grecaptcha.getResponse().length !== 0){
        // update/create expert in Salesforce
        createExpert();  
      }
    }
  });




}); //end ready