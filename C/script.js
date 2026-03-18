const openSignup = ()=>{
    document.querySelector('#login').hidePopover();
    document.querySelector('#signup').showPopover();
}
const openLogin = ()=>{
    document.querySelector('#signup').hidePopover();
    document.querySelector('#login').showPopover();
}