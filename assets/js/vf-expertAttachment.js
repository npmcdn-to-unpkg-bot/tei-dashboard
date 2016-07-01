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
      console.log('fetching Expert Attachment for expertID: '+ getUrlVars()["Id"]);
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

    styleFileInput();
    // Style file input 
    function styleFileInput(){
      console.log('stylin');
      $( '.inputfile' ).each( function()
      {
        var $input   = $( this ),
          $label   = $input.next( 'label' ),
          labelVal = $label.html();

        $input.on( 'change', function( e )
        {
          var fileName = '';

          if( this.files && this.files.length > 1 )
            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
          else if( e.target.value )
            fileName = e.target.value.split( '\\' ).pop();

          if( fileName )
            $label.find( 'span' ).html( fileName );
          else
            $label.html( labelVal );
        });

        // Firefox bug fix
        $input
        .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
        .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
      });
    }
  });