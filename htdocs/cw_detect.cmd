@echo off
setlocal enabledelayedexpansion
set a="d:\img"
@echo off
for /f "skip=1 delims== tokens=1,2 " %%i in (user.ini) do (
if "%%i"=="start_dir " echo "%%j"&& set a=%%j
)
rem set /p a=������user.ini��start_dir��ֵ(����Ҫ�����ļ���·��)��
@echo off
set b=%a:/=\%
echo %b%\*.cigit
@echo off
dir /b/s %b%\*.cigit > facedetect\filelist.txt
facedetect\FaceDetecionDemo_dir.exe facedetect\filelist.txt 
pause