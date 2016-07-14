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
    if(lcmtID == "005E0000004zFMJIA2"){
      lcmtID = '005E0000000fnHS'; // zach '005E0000000fnHS' : rana '005E0000007R945' : faiza '005E0000004JMEw' : philipp '005E0000004zFMJIA2'
    }

    
    var activeOppsArgs = {
            where:{
              Stage_LCMT_Active__c: {eq: true},
              and: {
                RecordTypeId: {ne: '012E0000000kDXO'},
                LCMT_User__c: {eq: lcmtID} 
              }                 
            },
            limit: 100
        };
  
    var closingOppsArgs = {
            where:{
              Stage_LCMT_Closing__c: {eq: true},
              and: {
                RecordTypeId: {ne: '012E0000000kDXO'},
                LCMT_User__c: {eq: lcmtID} 
              }                 
            },
            limit: 100
        };


    function fetchOpps(args,tableElement){
        var opp = new SObjectModel.opp();
        opp.retrieve(args, function(err,records){
            if(err) {
              console.log(err.message);
            }else {
                console.log('found: ' +records.length + ' Opps');
                var rowNum=0;          
                records.forEach(function(record){
                    rowNum++;                    
                    var oppObj = {
                        Id: record.get('Id'),
                        O_ID__c: record.get('O_ID__c'),
                        Name: record.get('Name'),
                        StageName: record.get('StageName'),
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
                        Conference_Call_User__c: record.get('Conference_Call_User__c'),
                        Experts_Choosen__c:record.get('Experts_Choosen__c'),
                        LCMT_New_Opp__c: record.get('LCMT_New_Opp__c'),
                        Time_since_LCMT_Assigned__c: record.get('Time_since_LCMT_Assigned__c')

                    }
                    console.log('LOADED Opp: ',oppObj);

                    //check for new flag, add badge 
                    var newOppCheck = function(){
                     if(oppObj.LCMT_New_Opp__c){
                       return '<span class="new-opp-badge">NEW</span>';
                     } else {
                       return '';
                     }
                    };
                    // check for valid date assigned
                    var DateAssignedCheck = function(){
                      if(oppObj.Time_since_LCMT_Assigned__c){
                        return oppObj.Time_since_LCMT_Assigned__c;
                      } else {
                        return '';
                      }
                    }
                    // trim chatter length 
                    var trimChatter = function(chatter){
                      if(chatter){
                        return chatter.substring(0,200);  
                      } else {
                        return '';
                      }
                      
                    }

                    // Build table row for each Opp 
                    var tableRow = $('<tr>'+
                      '<td><a target="_blank" class="oppName" href="https://tei.my.salesforce.com/'+oppObj.Id+'">'+oppObj.O_ID__c+': '+oppObj.Name+'</a>'+
                      newOppCheck()+
                      '<div class="well stats-well">'+
                        '<ul class="opp-stats-list list-inline">'+
                          '<li class="opp-stat"><strong>E:</strong> '+oppObj.Experts__c+'</li>'+
                          '<li class="opp-stat"><strong>EA:</strong> '+oppObj.Expert_Answers__c+'</li>'+
                          '<li class="opp-stat"><strong>ES:</strong> '+oppObj.Expert_Share__c+'</li>'+
                          '<li class="opp-stat"><strong>CC:</strong> '+oppObj.Conference_Calls__c+'</li>'+
                          '<li class="opp-stat"><strong>EC:</strong> '+oppObj.Experts_Choosen__c+'</li>'+
                        '</ul>'+
                      '</div>'+
                      '</td>'+
                      '<td>'+oppObj.StageName+'</td>'+                            
                      '<td>'+oppObj.Specialty_Description__c+'</td>'+
                      '<td><div class="contact-image">'+decodeImg(oppObj.Contact_Image__c)+'</div></td>'+
                      '<td><div class="account-image">'+decodeImg(oppObj.Account_Logo_small__c)+'</div></td>'+
                      '<td class="last-chatter">'+trimChatter(oppObj.Last_Chatter__c)+'</td>'+
                      '<td>'+DateAssignedCheck()+'</td>'+
                    '</tr>'
                    );

                    // apend rows to correct table 
                    if(args.where.Stage_LCMT_Active__c !== undefined){
                      $('#tableActiveOpps').append(tableRow);
                    } else {
                      $('#tableClosingOpps').append(tableRow);
                    }                  
                    

                });
            }
            // set dataTable options 
            if ( ! $.fn.DataTable.isDataTable( tableElement ) ) {
              $(tableElement).dataTable({
                    "order": [[ 0, "desc" ]],
                    "pageLength": 50,
                    "columns": [
                      { "width": "25%" },
                      null,
                      null,
                      null,
                      { "width": "100px" },
                      null,
                      {"width": "20px"}
                    ]
                });
            }


        });
    } // end fetchOpps
    fetchOpps(activeOppsArgs,'#tableActiveOpps');


    // handle tab change 
    $('a[href="#LCMT_closing"]').one('click',function(e){
        e.preventDefault();
        fetchOpps(closingOppsArgs,'#tableClosingOpps');
    });

    //get user info 
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

    //get Conference Calls 
    function fetchConferenceCalls(){
      console.log('getting conference calls');
      var cc = new SObjectModel.cc();
      cc.retrieve({
        where: {
          LCMT_ID__c: {eq: lcmtID}
        },
        limit:100
      }, function(err,records){
        if(err){
          console.log(err.message);
        }else {
          records.forEach(function(record){
            var ccObj = {
              Id: record.get('Id'),
              Name: record.get('Name'),
              Opportunity_Name__c: record.get('Opportunity_Name__c'),
              Opportunity__c: record.get('Opportunity__c'),
              Expert__c: record.get('Expert__c'),
              E_ID__c: record.get('E_ID__c'),
              Contact__c: record.get('Contact__c'),
              Contact_Firstname__c: record.get('Contact_Firstname__c'),
              Contact_Lastname__c: record.get('Contact_Lastname__c'),
              Date_Conference_Call__c: record.get('Date_Conference_Call__c'),
              Status__c: record.get('Status__c')
            };
            console.log('fetching Conference Calls',ccObj);
            var tableRow = '<tr>'+
              '<td><a href="https://tei.my.salesforce.com/'+ccObj.Id+'" target="_blank">'+ccObj.Opportunity_Name__c+'</a></td>'+
              '<td>'+ccObj.Status__c+'</td>'+
              '<td>'+ccObj.Date_Conference_Call__c+'</td>'+
              '<td><a href="https://tei.my.salesforce.com/'+ccObj.Contact__c+'" target="_blank">'+ccObj.Contact_Firstname__c+ ' ' + ccObj.Contact_Lastname__c +'</a></td>'+
              '<td><a href="https://tei.my.salesforce.com/'+ccObj.Expert__c+'" target="_blank">'+ccObj.E_ID__c +'</a></td>'+
              '</tr>';
              $('#tableConferenceCalls').append(tableRow);
          });

          // set dataTable options 
          if ( ! $.fn.DataTable.isDataTable( '#tableConferenceCalls' ) ) {
            $('#tableConferenceCalls').dataTable({
                  "order": [[ 0, "desc" ]],
                  "pageLength": 50,
                  "columns": [
                    { "width": "25%" },
                    null,
                    null,
                    null,
                    null
                  ]
              });
          }
        }
      }); 
    };
    fetchConferenceCalls();

    //image decoding
    function decodeImg(imgString){
      var d = $("<p/>").html(imgString).text();
      return d;
    };



}); //end ready