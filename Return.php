<?php
session_start();
?>
<html>
<head>
    <title>
        Store Editor
    </title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
            border: solid 1px #aaa;
            border-radius: 10px;
            font-size: 1em;
        }

        .noBorder {
            border-color: #fff;
        }
        td, th {
            padding: 10px;
        }

        td, th {
            border: solid 1px #aaa;
        }

        th {
            background-color: #dedede;
            font-size: 1em;
        }

        td {
            border-color: #fff;
            border-top-color: #fff;
        }

        .btn {
            font-size: 1em;
            text-align: center;
            vertical-align: center;
            padding: 15px;
        }
    </style>
    <script type="text/javascript" src='jquery-1.4.1.js'></script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Customer Out Items/Return for: <?php echo $_SESSION['name']; ?></h2>
<form method=post action="">
    <table>
        <tr>
            <th> Title </th>
            <th> ISBN </th>
            <th> Store Name </th>
            <th> Type </th>
            <th> Out Date </th>
            <th> Due Date </th>
            <th> TID </th>
        </tr>
        <tr>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
        </tr>
        <tr>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
        </tr>
        <tr>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
        </tr>
        <tr>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
        </tr>
        <tr>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
        </tr>
        </table>
        <table class="noBorder">
        <tr>
            <td>  </td>
            <td colspan="2" class="submitBtnTd"> <input class='btn' type="button" name="returnCheckedBooks" id="returnCheckedBooks" value="Return Checked Books"> </td>
            <td colspan="2" class="submitBtnTd"> <input class='btn' type="button" name="selfReturn" id="selfReturn" value="I return borrowed books myself"> </td>
        </tr>
    </table>
</form>
</body>
</html>
