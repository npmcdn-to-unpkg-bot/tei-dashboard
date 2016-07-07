  $(document).ready(function() {
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


    fetchOppDetail();
    fetchOppExpert();

    //handle feedback submission
    $('#btnSave').on('click',function(e){
      console.log('saving');
        e.preventDefault();
        saveFeedback();
    });

    function formatQuestions(){
      var rawQuestions =$('#expert-questions').html();
           $('#expert-questions').html(rawQuestions.trim());
    }
    //Function to fetch Opps 
      function fetchOppDetail(){
        console.log('fetching Opportunty with ID: '+ getUrlVars()["Id"]);
        var Opp = new SObjectModel.opp();
          Opp.retrieve({
            where: {
              Id: {eq: getUrlVars()["Id"] }
            },
            limit: 100
          }, function (err, records){
            if(err){
              console.log(err.message);
            }
            else {       
            // console.log(records);       
              records.forEach(function(record){
                  var OppObj = {
                    name: record.get('Name'),
                    Id: record.get('Id'),
                    Case_Summery_or_Expert__c: record.get('Case_Summery_or_Expert__c'),
                    Case_Summary_for_Expert_Images__c: record.get('Case_Summary_for_Expert_Images__c'),
                    ExpertId__c: record.get('ExpertId__c'),
                    Opportunity__c: record.get('Opportunity__c'),
                    Opp_Name__c: record.get('Opp_Name__c')
                  };        

                  BuildCaseSummaryMediaSection(OppObj.Case_Summary_for_Expert_Images__c);          
              });
              
            }
          });
      }

      // build case images /media section 
      var BuildCaseSummaryMediaSection = function(mediaString){
        if(mediaString !== undefined){
                                
          var decodedmediaString = $("<p/>").html(mediaString).text(); 
          var caseSummaryMedia = $.parseHTML(decodedmediaString);
          
          var csMediaSection = $('<div class="row expert-profile-section"><div class="col-md-12"><h3 class="heading-underline"><span class="text-underline">Case Media</span></h3><div id="case-media"></div></div></div>');                      
          $('.case-overview').closest('.expert-profile-section').after(csMediaSection);
          $('#case-media').append(caseSummaryMedia);
        } else {
          
        }
      }
      

      // get Opportunity-Expert info 
      function fetchOppExpert(){
        var oppExpertID = getUrlVars()["idOppExpert"]; 
        console.log('fetching Expert with ID: '+ oppExpertID);
        var OppExp = new SObjectModel.oppExp();
        OppExp.retrieve({
          where: {
            Id: {eq: oppExpertID }
          },
          limit: 100
        },function(err,records){
          if(err){
            console.log(err.message);
          } else {
            records.forEach(function(record){
                var oppExpObj = {
                  name: record.get('Name'),
                  Id: record.get('Id'),
                  Expert__c: record.get('Expert__c'),
                  ExpertId__c: record.get('ExpertId__c'),
                  Title__c: record.get('Title__c'),
                  Lastname__c: record.get('Lastname__c'),
                  Opportunity__c: record.get('Opportunity__c'),
                  Opp_Name__c: record.get('Opp_Name__c'),
                  Specific_Qualifications__c: record.get('Specific_Qualifications__c'),
                  Expert_Answer__c: record.get('Expert_Answer__c'),
                  LCMT_USER__c: record.get('LCMT_USER__c'),
                  LCMT_USER_Email__c: record.get('LCMT_USER_Email__c'),
                  LCMT_USER_Phone__c: record.get('LCMT_USER_Phone__c'),
                  LCMT_USER_Picture__c: record.get('LCMT_USER_Picture__c'),
                  Contacting_Expert_Template__c: record.get('Contacting_Expert_Template__c')

                };
                console.log(oppExpObj);

                $('#OppExpertID').val(oppExpObj.Id);

                // update case manager card:
                $('#LCMT_USER__c').html(oppExpObj.LCMT_USER__c);
                
                $('#LCMT_USER_Email__c').attr('href','mailto:'+oppExpObj.LCMT_USER_Email__c).html(oppExpObj.LCMT_USER_Email__c);
                
                $('#LCMT_USER_Phone__c').attr('href','tel:'+oppExpObj.LCMT_USER_Phone__c).html(oppExpObj.LCMT_USER_Phone__c);
                $('#LCMT_USER_Picture__c').css('background-image', 'url(' + oppExpObj.LCMT_USER_Picture__c + ')');

                $('.case-intro-title').html(oppExpObj.Title__c + ' ' + oppExpObj.Lastname__c) + ',';
                $('.case-intro-signature').html(oppExpObj.LCMT_USER__c);

                $('#inputInitialThoughts').val(oppExpObj.Expert_Answer__c);
                $('#InputSpecificQualifications').val(oppExpObj.Specific_Qualifications__c);

              formatQuestions();
                
            });

          }
        });
      };


      // Save Feedback
      function saveFeedback(){
        var expertFeedback = new SObjectModel.oppExp({
          Specific_Qualifications__c: $('#InputSpecificQualifications').val(),
          Expert_Answer__c: $('#inputInitialThoughts').val()
        });

       var oppExpertID = $('#OppExpertID').val();
       //If expertID is null then Create new Expert
       if(!oppExpertID){
         expertFeedback.create(updateCallback);
       }else{
       //Id oppExpertID has value then update the Expert record
         expertFeedback.set('Id',oppExpertID);
         expertFeedback.update(updateCallback);
       }
      }

  
      // Callback to handle DML Remote Objects calls
      function updateCallback(err, ids){
        if (err) { 
            alert(err); 
        } else {
            alert('SAVED!');
            console.log('saved')
        }
      }



  });