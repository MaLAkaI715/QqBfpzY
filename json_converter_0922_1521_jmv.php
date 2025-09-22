<?php
// 代码生成时间: 2025-09-22 15:21:26
class JsonConverter {

    /**
     * 将JSON字符串转换为PHP数组
     *
     * @param string $json JSON字符串
     * @return array|false 返回转换后的数组，失败时返回false
     */
    public function decodeToArray($json) {
        try {
            // 开启错误抑制，以避免JSON解析错误导致脚本终止
            $array = @json_decode($json, true);
            if (is_null($array)) {
                throw new Exception('JSON解码失败：无效的JSON格式');
            }
            return $array;
        } catch (Exception $e) {
            // 错误处理
            // 记录日志、输出错误信息或进行其他错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 将JSON字符串转换为PHP对象
     *
     * @param string $json JSON字符串
     * @return object|false 返回转换后的对象，失败时返回false
     */
    public function decodeToObject($json) {
        try {
            // 开启错误抑制，以避免JSON解析错误导致脚本终止
            $object = @json_decode($json);
            if (is_null($object)) {
                throw new Exception('JSON解码失败：无效的JSON格式');
            }
            return $object;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 将PHP数组或对象转换为JSON字符串
     *
     * @param mixed $data PHP数组或对象
     * @return string|false 返回JSON字符串，失败时返回false
     */
    public function encode($data) {
        try {
            // 开启错误抑制，以避免JSON编码错误导致脚本终止
            $json = @json_encode($data);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSON编码失败：' . json_last_error_msg());
            }
            return $json;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }
}

// 使用示例：
// $converter = new JsonConverter();
// $jsonString = '{"name":"John", "age":30}';
// $array = $converter->decodeToArray($jsonString);
// $object = $converter->decodeToObject($jsonString);
// $encodedJson = $converter->encode($array);
