# DBLog

Log database operation to files

## Installing

### install
```
composer required noking50/dblog
```

### config
```
```

## Usage

write log to file
```
DBLog::write($table_name, $data_before_modify, $data_after_modify);
```
If insert data, $data_before_modify is null,
If delete data, $data_after_modify is null,

