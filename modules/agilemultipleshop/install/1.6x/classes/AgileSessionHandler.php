<?php /*
///-build_id: 2014101516.0537
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/store/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///
*/
${"\x47\x4c\x4fB\x41\x4cS"}["\x6d\x79u\x73\x6d\x6e\x73"]="d\x61\x74a";${"\x47\x4c\x4fB\x41\x4c\x53"}["\x68\x67\x75\x74t\x74q\x6f"]="\x69\x64";${"G\x4c\x4f\x42\x41L\x53"}["\x73\x75ur\x67\x68\x6e"]="\x73d";class AgileSessionHandler{private$sd;public function __construct(AgileSessionData$sd=null){if(isset(${${"\x47LO\x42\x41\x4c\x53"}["s\x75urg\x68\x6e"]})){${"GL\x4fB\x41L\x53"}["\x6di\x7ayo\x69\x6f\x73vpc"]="\x73d";$this->sd=${${"GL\x4f\x42\x41L\x53"}["\x6d\x69\x7ayo\x69os\x76\x70\x63"]};}else{$this->sd=new AgileSessionData();}}public function open($path,$name){$sid=Tools::getValue("\x73i\x64");if(!empty($sid))session_id($sid);return true;}public function close(){return true;}public function read($id){return$this->sd->get(${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x68\x67ut\x74tqo"]});}public function write($id,$data){return$this->sd->set(${${"G\x4c\x4f\x42\x41LS"}["\x68\x67\x75t\x74\x74\x71\x6f"]},${${"\x47\x4c\x4fBAL\x53"}["\x6d\x79\x75s\x6d\x6e\x73"]});}public function gc($seconds){${"G\x4cO\x42\x41\x4c\x53"}["j\x74i\x6f\x65g\x73\x76p\x6b"]="\x73e\x63\x6fnd\x73";return$this->sd->clean(${${"\x47\x4c\x4fB\x41\x4c\x53"}["j\x74\x69o\x65\x67\x73\x76\x70\x6b"]});}public function destroy($id){${"\x47\x4c\x4f\x42\x41\x4cS"}["\x73xx\x64\x69\x76\x69w"]="\x69d";return$this->sd->delete(${${"\x47\x4c\x4f\x42\x41L\x53"}["s\x78\x78d\x69vi\x77"]});}public function __destruct(){session_write_close();}}
?>