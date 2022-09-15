@component('mail::message')
Your Article Updated Successfully. <br>
for see that please copy this url to your postman with get method
<br>
[{{ env('APP_URL','http://127.0.0.1:8000').'/api/v1/articles/'.$article->slug }}]({{ env('APP_URL','http://127.0.0.1:8000').'/api/v1/articles/'.$article->slug }})
@endcomponent
