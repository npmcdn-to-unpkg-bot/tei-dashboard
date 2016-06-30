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


    fetchAttachments();

    //Function to fetch Attachments 
    function fetchAttachments(expertID){
      console.log('fetching Expert Attachment for expertID: '+ expertID);
      var expAttch = new SObjectModel.expAttachment();
        expAttch.retrieve({
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
                var expAttachmentObj = {
                  Name: record.get('Name'),
                  Id: record.get('Id'),
                  Type__c: record.get('Type__c'),
                  Expert__c: record.get('Expert__c'),
                  Share__c: record.get('Share__c'),
                  Attachment__c: record.get('Attachment__c'),
                  Description__c: record.get('Description__c')
                };
                var checkbox;
                if(expAttachmentObj.Share__c == true){
                   checkbox = "checked";
                   console.log(checkbox);
                }
                var tableRow = $('<tr>'+
                  '<td><a target="_self" href="https://logintei.staging.wpengine.com/wp-content/themes/tei-dashboard/download_attachment.php?ID='+expAttachmentObj.Attachment__c+'&name='+expAttachmentObj.Name+'">'+expAttachmentObj.Name+'</a></td>'+//attchment name 
                  '<td>'+expAttachmentObj.Type__c+'</td>'+ // type                            
                  '<td><input type="checkbox" '+checkbox+'></td>'+
                '</tr>');
                $('.attachmentTable').append(tableRow);
            });
          }
        });
    }
  });