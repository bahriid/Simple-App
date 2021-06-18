# Dot Hiring Technical Test

This is Sample Project for Dot Hiring Technical Test

## Installation

Clone this repository and run this command on your terminal

```bash
composer install
```

After that you can run it with artisan command

## Pattern Explaination

I use laravel as the base for this project. For the pattern here for the response I use ResponseFormatter.php so that when returning something is easier. So each function will return a ResponseFormatter along with the code, message and data that will be returned.

The rest as usual use the default pattern from laravel such as Controller, Model, View. Using validators, and using error handling which also uses the ResponseFormatter earlier.

For caching I use redis, because it's easier to implement and that's all I've ever done before.

I don't really understand the pattern but this is the project.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
