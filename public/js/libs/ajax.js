function ajax (el, success_callback)
{
    $(el).submit(function(e)
    {
        e.preventDefault();
        var url = $(this).attr("action");
        var postData = $(this).serialize();

        $.post(url, postData, function(o)
        {
            if (typeof success_callback == "function")
            {
                success_callback(o);
            }
        });
    });
}