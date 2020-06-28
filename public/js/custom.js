$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
    });

    $(".ajax-delete").click(function () {
        const self = $(this);

        if (confirm("Do you want to delete?")) {
            $.ajax({
                url: self.data("url"),
                type: "DELETE",
                success: function (res) {
                    if (res.success) {
                        $("#" + self.data("id")).html("");
                    } else {
                        if (
                            confirm(
                                res.message +
                                    "\nDo you want to refresh the page?"
                            )
                        )
                            window.location.reload();
                    }
                },
                error: function (res) {
                    if (
                        confirm(
                            res.responseJSON.message +
                                "\nDo you want to refresh the page?"
                        )
                    )
                        window.location.reload();
                },
            });
        }
    });

    $(".ajax-toggle-approved").click(function () {
        const self = $(this);

        if (confirm("Do you want to toggle approved?")) {
            $.ajax({
                url: self.data("url"),
                type: "PUT",
                success: function (res) {
                    if (res.success) {
                        let html = "",
                            className = "";

                        if (res.message === "Approved") {
                            html = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.5 8a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            Disapprove`;
                            className =
                                "btn btn-outline-danger container-fluid ajax-toggle-approved";
                        } else {
                            html = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    </svg> 
                                    Approve`;
                            className =
                                "btn btn-outline-success container-fluid ajax-toggle-approved";
                        }

                        $("#" + self.data("id")).html(html);
                        $("#" + self.data("id"))
                            .removeClass()
                            .addClass(className);
                    } else {
                        if (
                            confirm(
                                res.message +
                                    "\nDo you want to refresh the page?"
                            )
                        )
                            window.location.reload();
                    }
                },
                error: function (res) {
                    if (
                        confirm(
                            res.responseJSON.message +
                                "\nDo you want to refresh the page?"
                        )
                    )
                        window.location.reload();
                },
            });
        }
    });
});
