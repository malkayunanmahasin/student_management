document.addEventListener('DOMContentLoaded', function(){
const search = document.querySelector('input[name="q"]');
if(search){
search.addEventListener('keypress', function(e){
if(e.key === 'Enter') this.form.submit();
});
}
});