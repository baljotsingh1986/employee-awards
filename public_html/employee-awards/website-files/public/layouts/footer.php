</div>
        <footer>
            <p >Copyright&copy;&nbsp;<?php echo date("Y", time());?>&nbsp;Green Arrow Consulting</p>
        </footer>
		<script src="<?php if(isset($script)){echo $script;} ?>" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    </body>
</html>
<?php 
if(isset($database)) {
    $database->close_connection();
}
?>