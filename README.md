# Resolver_oi

## �ϥλ���:
- �t�X [scoreboard](https://github.com/lys0829/scoreboard_api) �ϥ�
### �B�J:
1. �ƻs```config.example.php```��P�ؿ��A�R�W��```config.php```
2. �Nscoreboard��data���resolver�ؿ����U
3. �ק�```config.php```

OPTION | ����
---|---
$_config['class'] |class���W��(�]�N�Oscoreboard data��Ƨ����W��)
$_config['contest'] |contest���W��(�@��class�i��J�h��contest)
$_config['start_time'] |�v�ɶ}�l�ɶ��A���ɶ��|�M�w�O���O���p��(UNIX time)
$_config['end_time'] |�v�ɵ����ɶ��A���ɶ��|�M�w�O���O���p��(UNIX time)
$_config['freeze_time'] |�O���O�ᵲ�ɶ��Aresolver�|�N���ɶ����᪺�Ҧ��W�ǳ]��pending(UNIX time)

4. ��bash����```output_to_resolver.php```
5. �}���s�����A���}:```[host]/resolver/index.php/[class]/[contest]```
6. ���ť���K�|�}�lresolver