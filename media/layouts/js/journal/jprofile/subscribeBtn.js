(function () {
    window.subscribe = (element, userId, isSubscribed) => {
        if (isSubscribed){
            var method = 'unsubscribe';
        } else {
            var method = 'subscribe';
        }
        $.ajax({
            type: "POST",
            url: `index.php?option=com_jprofile&task=ajax.${method}&format=json`,
            headers: {
                'X-CSRF-Token': Joomla.getOptions("csrf.token")
            },
            data: {
                object_id: element.dataset.objectId,
                subject_id: userId,
            },
            beforeSend: function() {
                let icon = document.createElement("span");
                icon.classList.add('icon-spinner');
                icon.classList.add('icon-pulse');
                element.appendChild(icon);
            }
        })
            .done(function () {
                let message;
                if (method == 'unsubscribe'){
                    element.innerText = "Подписаться"
                    element.setAttribute('onclick',`subscribe(this,${userId},0)`);
                    message = "Вы отписались"
                } else {
                    element.innerText = "Отписаться"
                    element.setAttribute('onclick',`subscribe(this,${userId},1)`);
                    message = "Вы подписались"
                }
                Joomla.renderMessages({
                    "success": [message]
                });
            })
            .fail(function () {
                Joomla.renderMessages({
                    "error": ["Что-то пошло не так, пожалуйста, попробуйте позже"]
                });
            })
    }
})();