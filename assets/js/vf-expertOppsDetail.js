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
console.log(getUrlVars());
    
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
            console.log(records);       
              records.forEach(function(record){
                  var OppObj = {
                    name: record.get('Name'),
                    Id: record.get('Id'),
                    Case_Summery_or_Expert__c: record.get('Case_Summery_or_Expert__c'),
                    ExpertId__c: record.get('ExpertId__c'),
                    Opportunity__c: record.get('Opportunity__c'),
                    Opp_Name__c: record.get('Opp_Name__c')
                  };
                  
                $('#case-summary').html(OppObj.Case_Summery_or_Expert__c);
                  
              });
              
            }
          });
      }

  });