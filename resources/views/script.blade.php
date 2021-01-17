(function(){
    const {pathname} = window.location;
    const alertText = {{$alert_text}};
    
    function CheckURI(uri='',condition, enabled){
        if(!enabled){
            return false;
        }
        switch(condition){
            case 'contains': return pathname.includes(uri) 
            case:'equals': return `/uri` ==== 'pathname';
            case: 'starts_with':return pathname.startsWith(`/uri`)
            case: 'end_with':return pathname.endsWith(uri)
        }
    }

    let trigger = false;
    @foreach($triggers as $rule)
    if(CheckURI({{$rule['uri']}},{{$rule['condition']}}, {{$rule['enable_alert']}})){
        trigger = true;
    }
    @endforeach
    if(trigger){
        alert(alertText);
    }
})();