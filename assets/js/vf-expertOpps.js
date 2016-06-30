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


    fetchOpps();

    
    //Function to fetch Opps 
      function fetchOpps(){
        console.log('fetching Expert Opps for expertID: '+ getUrlVars()["Id"]);
        var OppExp = new SObjectModel.oppExp();
          OppExp.retrieve({
            where: {
              Expert__c: {eq: getUrlVars()["Id"] }
            },
            limit: 100
          }, function (err, records){
            if(err){
              console.log(err.message);
            }
            else {              
              records.forEach(function(record){
                  var oppExpObj = {
                    name: record.get('Name'),
                    Id: record.get('Id'),
                    Expert__c: record.get('Expert__c'),
                    ExpertId__c: record.get('ExpertId__c'),
                    Opportunity__c: record.get('Opportunity__c'),
                    Opp_Name__c: record.get('Opp_Name__c')
                  };
                  // console.log(oppExpObj);
                  var tableRow = $('<tr>'+
                    '<td><a href="https://tei.my.salesforce.com/'+oppExpObj.Opportunity__c+'" target="_blank">'+oppExpObj.Opp_Name__c+'</a></td>'+
                    '<td>'+oppExpObj.Opportunity__c+'</td>'+                            
                    // '<td>john@example.com</td>'+
                  '</tr>');
                  $('.oppTable').append(tableRow);
                  
              });
              //init dataTable plugin

              $('.datatable').dataTable({
                    "order": [[ 0, "desc" ]]
                });
            }
          });
      }

  });