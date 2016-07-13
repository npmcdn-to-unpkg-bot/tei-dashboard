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

    // live
    var lcmtID = $('#lcmtID').html().trim();
    
    // testing
    // var lcmtID = '005E0000007R945'; // zach '005E0000000fnHS' : rana '005E0000007R945'
    


    function fetchOpps(){
        var opp = new SObjectModel.opp();
        opp.retrieve({
            where:{
              Stage_LCMT_Active__c: {eq: true},
              and: {
                RecordTypeId: {ne: '012E0000000kDXO'},
                LCMT_User__c: {eq: lcmtID} 
              }                 
            },
            limit: 100
        }, function(err,records){
            if(err) {
              console.log(err.message);
                // alert(err.message);
            }else {
                console.log('found: ' +records.length + ' Opps');

                records.forEach(function(record){

                    var oppObj = {
                        Id: record.get('Id'),
                        name: record.get('Name'),
                        stage: record.get('StageName'),
                        RecordType: record.get('RecordTypeId'),
                        Specialty_Description__c: record.get('Specialty_Description__c'),
                        Account_Logo_small__c: record.get('Account_Logo_small__c'),
                        Contact_Image__c: record.get('Contact_Image__c'),
                        Business_Days_Contacting_to_Share__c: record.get('Business_Days_Contacting_to_Share__c'),
                        Business_Days_Contacting_2_to_Share_2__c: record.get('Business_Days_Contacting_2_to_Share_2__c'),
                        Date_Approved_Inquiry__c: record.get('Date_Approved_Inquiry__c'),
                        Last_Chatter__c: record.get('Last_Chatter__c'),
                        Experts__c:record.get('Experts__c'),
                        Expert_Answers__c:record.get('Expert_Answers__c'),
                        Expert_Share__c:record.get('Expert_Share__c'),
                        Conference_Calls__c:record.get('Conference_Calls__c'),
                        Experts_Choosen__c:record.get('Experts_Choosen__c')
                    }
                    console.log('LOADED Opps:',oppObj);

                     
                    var tableRow = $('<tr>'+
                      '<td><a href="https://tei.my.salesforce.com/'+oppObj.Id+'">'+oppObj.name+'</a>'+
                      '<div class="well stats-well">'+
                        '<ul class="opp-stats-list list-inline">'+
                          '<li class="opp-stat">'+oppObj.Experts__c+'</li>'+
                          '<li class="opp-stat">'+oppObj.Expert_Answers__c+'</li>'+
                          '<li class="opp-stat">'+oppObj.Expert_Share__c+'</li>'+
                          '<li class="opp-stat">'+oppObj.Conference_Calls__c+'</li>'+                          
                          '<li class="opp-stat">'+oppObj.Experts_Choosen__c+'</li>'+
                        '</ul>'+
                      '</div>'+
                      '</td>'+
                      '<td>'+oppObj.stage+'</td>'+                            
                      '<td>'+oppObj.Specialty_Description__c+'</td>'+
                      '<td><div class="contact-image">'+decodeImg(oppObj.Contact_Image__c)+'</div></td>'+
                      '<td><div class="account-image">'+decodeImg(oppObj.Account_Logo_small__c)+'</div></td>'+
                      '<td class="last-chatter">'+oppObj.Last_Chatter__c+'</td>'+
                    '</tr>');                  
                    $('.oppTable').append(tableRow);

                });
            }
          $('.datatable').dataTable({
                "order": [[ 0, "desc" ]],
                "pageLength": 50,
                "columns": [
                  { "width": "400px" },
                  null,
                  null,
                  null,
                  null,
                  null
                ]
            });
        });
    } // end fetchOpps
    fetchOpps();
    function fetchUser(){
      var usr = new SObjectModel.usr();
      usr.retrieve({
        where: {
          Id: {eq: lcmtID}
        },
        limit:1
      }, function(err,records){
        if(err){
          console.log(err.message);
        }else {
          records.forEach(function(record){
            var userObj = {
              Id: record.get('Id'),
              Name: record.get('Name'),
              U_ID__c: record.get('U_ID__c'),
              User_Picture__c: record.get('User_Picture__c'),
              User_Picture_Url__c: record.get('User_Picture_Url__c')
            };
            $('#lcmtPic').attr('src', userObj.User_Picture_Url__c);
        });
      }
    }); 
    };
    fetchUser();

    //image decoding
    function decodeImg(imgString){
      var d = $("<p/>").html(imgString).text();

      return d;
    };



}); //end ready