$(document).ready(function () {
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validateMemberID(memberID) {
        const memberIDRegex = /^M\d{3}$/;
        return memberIDRegex.test(memberID);
    }

    $("#memberForm").on("submit", function (event) {
        const email = $("#email").val();
        const memberID = $("#member_id").val();

        if (!validateEmail(email)) {
            alert("Invalid email format. Please enter a valid email.");
            event.preventDefault();
        }

        if (!validateMemberID(memberID)) {
            alert("Invalid Member ID format. It should be in the format 'MXXX' (e.g., M001).");
            event.preventDefault();
        }
    });

    function fetchMembers() {
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: { action: 'fetch' },
            success: function (response) {
                const members = JSON.parse(response);
                let rows = "";
                members.forEach(member => {
                    rows += `
                        <tr>
                            <td>${member.member_id}</td>
                            <td>${member.first_name}</td>
                            <td>${member.last_name}</td>
                            <td>${member.birthday}</td>
                            <td>${member.email}</td>
                            <td>
                                <button class='update-btn' data-id='${member.member_id}'>Update</button>
                                <button class='delete-btn' data-id='${member.member_id}'>Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $("#membersTable tbody").html(rows);
            }
        });
    }

    $(document).on("click", ".delete-btn", function () {
        const memberID = $(this).data("id");

        if (confirm("Are you sure you want to delete this member?")) {
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: { action: 'delete', member_id: memberID },
                success: function () {
                    fetchMembers();
                }
            });
        }
    });

    $(document).on("click", ".update-btn", function () {
        const memberID = $(this).data("id");

        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: { action: 'get_member', member_id: memberID },
            success: function (response) {
                const member = JSON.parse(response);
                $("#member_id").val(member.member_id).prop('disabled', true);
                $("#firstname").val(member.first_name);
                $("#lastname").val(member.last_name);
                $("#birthday").val(member.birthday);
                $("#email").val(member.email);
                $("#updateButton").show();
                $("input[type=submit]").hide();
            }
        });
    });

    $("#updateButton").on("click", function () {
        const memberID = $("#member_id").val();
        const firstname = $("#firstname").val();
        const lastname = $("#lastname").val();
        const birthday = $("#birthday").val();
        const email = $("#email").val();

        if (validateEmail(email) && validateMemberID(memberID)) {
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
                    action: 'update',
                    member_id: memberID,
                    firstname: firstname,
                    lastname: lastname,
                    birthday: birthday,
                    email: email
                },
                success: function () {
                    fetchMembers();
                    $("#memberForm")[0].reset();
                    $("#member_id").prop('disabled', false);
                    $("#updateButton").hide();
                    $("input[type=submit]").show();
                }
            });
        } else {
            alert("Invalid input. Please check your data.");
        }
    });

    fetchMembers(); // Initial fetch
});
